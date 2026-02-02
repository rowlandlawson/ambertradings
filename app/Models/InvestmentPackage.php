<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'min_amount',
        'max_amount',
        'roi_percentage',
        'duration_days',
        'risk_level',
        'is_active',
        'icon',
    ];

    protected function casts(): array
    {
        return [
            'min_amount' => 'decimal:2',
            'max_amount' => 'decimal:2',
            'roi_percentage' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get investments using this package.
     */
    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    /**
     * Scope to get only active packages.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get the risk level badge color.
     */
    public function getRiskBadgeColorAttribute(): string
    {
        return match($this->risk_level) {
            'low' => 'success',
            'medium' => 'warning',
            'high' => 'danger',
            default => 'secondary',
        };
    }
}
