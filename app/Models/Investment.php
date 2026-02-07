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
        'withdrawable_profit',
        'loss',
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
            'withdrawable_profit' => 'decimal:2',
            'loss' => 'decimal:2',
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
     * Get the investment top-ups.
     */
    public function topups()
    {
        return $this->hasMany(InvestmentTopup::class);
    }

    /**
     * Get the current value of the investment.
     * If loss > profit, excess loss deducts from principal.
     * Formula: amount - max(0, loss - withdrawable_profit) + withdrawable_profit
     * Simplified: amount + withdrawable_profit - loss
     */
    public function getCurrentValueAttribute(): float
    {
        $value = (float) $this->amount + (float) $this->withdrawable_profit - (float) $this->loss;
        return max(0, $value); // Cannot go below 0
    }

    /**
     * Get the effective principal after losses.
     * If profit doesn't cover loss, principal is reduced.
     */
    public function getEffectivePrincipalAttribute(): float
    {
        $excessLoss = max(0, (float) $this->loss - (float) $this->withdrawable_profit);
        return max(0, (float) $this->amount - $excessLoss);
    }

    /**
     * Get the capital loss (loss that ate into principal).
     */
    public function getCapitalLossAttribute(): float
    {
        return max(0, (float) $this->loss - (float) $this->withdrawable_profit);
    }

    /**
     * Get net profit/loss for display.
     * Positive = profit, Negative = net loss.
     */
    public function getNetProfitAttribute(): float
    {
        return (float) $this->withdrawable_profit - (float) $this->loss;
    }

    /**
     * Check if investment has withdrawable profit.
     */
    public function hasWithdrawableProfit(): bool
    {
        return (float) $this->withdrawable_profit > 0;
    }

    /**
     * Check if investment has capital loss (loss exceeds profit).
     */
    public function hasCapitalLoss(): bool
    {
        return (float) $this->loss > (float) $this->withdrawable_profit;
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
