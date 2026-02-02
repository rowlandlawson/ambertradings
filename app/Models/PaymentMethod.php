<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'icon',
        'wallet_address',
        'bank_details',
        'instructions',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'bank_details' => 'array',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Get all deposit requests for this payment method.
     */
    public function depositRequests(): HasMany
    {
        return $this->hasMany(DepositRequest::class);
    }

    /**
     * Check if this payment method is configured (has address/details).
     */
    public function isConfigured(): bool
    {
        if ($this->type === 'crypto') {
            return !empty($this->wallet_address);
        }
        return !empty($this->bank_details);
    }

    /**
     * Get the display icon.
     */
    public function getIconClassAttribute(): string
    {
        return $this->icon ?? match($this->name) {
            'Bitcoin (BTC)' => 'fab fa-bitcoin',
            'Ethereum (ETH)' => 'fab fa-ethereum',
            'USDT (Tether)' => 'fas fa-coins',
            'Bank Transfer' => 'fas fa-university',
            default => 'fas fa-wallet',
        };
    }
}
