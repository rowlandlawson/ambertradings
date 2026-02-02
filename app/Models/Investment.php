<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'investment_package_id',
        'type',
        'amount',
        'profit',
        'roi_percentage',
        'status',
        'start_date',
        'end_date',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'profit' => 'decimal:2',
            'roi_percentage' => 'decimal:2',
            'start_date' => 'datetime',
            'end_date' => 'datetime',
        ];
    }

    /**
     * Get the user that owns the investment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the investment package.
     */
    public function package()
    {
        return $this->belongsTo(InvestmentPackage::class, 'investment_package_id');
    }

    /**
     * Get the status badge color.
     */
    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'active' => 'primary',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary',
        };
    }
}
