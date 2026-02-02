<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
        'status',
        'description',
        'reference',
        'payment_method',
        'metadata',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'metadata' => 'array',
        ];
    }

    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'completed' => 'success',
            'failed' => 'danger',
            'cancelled' => 'secondary',
            default => 'info',
        };
    }

    /**
     * Get the type icon.
     */
    public function getTypeIconAttribute(): string
    {
        return match($this->type) {
            'deposit' => 'fas fa-arrow-down',
            'withdrawal' => 'fas fa-arrow-up',
            'investment' => 'fas fa-chart-line',
            'profit' => 'fas fa-arrow-trend-up',
            'loss' => 'fas fa-arrow-trend-down',
            default => 'fas fa-exchange-alt',
        };
    }

    /**
     * Generate a unique reference for transactions.
     */
    public static function generateReference(): string
    {
        return 'TXN-' . strtoupper(uniqid()) . '-' . time();
    }
}
