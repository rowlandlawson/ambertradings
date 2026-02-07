<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentTopup extends Model
{
    use HasFactory;

    protected $fillable = [
        'investment_id',
        'user_id',
        'amount',
        'status',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    /**
     * Get the investment this top-up belongs to.
     */
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    /**
     * Get the user who made the top-up.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
