<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $methods = [
            [
                'name' => 'Bitcoin (BTC)',
                'type' => 'crypto',
                'icon' => 'fab fa-bitcoin',
                'wallet_address' => null,
                'bank_details' => null,
                'instructions' => 'Send the exact amount to the wallet address shown. Transaction will be confirmed after 3 network confirmations.',
                'is_active' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Ethereum (ETH)',
                'type' => 'crypto',
                'icon' => 'fab fa-ethereum',
                'wallet_address' => null,
                'bank_details' => null,
                'instructions' => 'Send ETH to the address shown. Gas fees are separate from your deposit amount.',
                'is_active' => false,
                'sort_order' => 2,
            ],
            [
                'name' => 'USDT (Tether)',
                'type' => 'crypto',
                'icon' => 'fas fa-coins',
                'wallet_address' => null,
                'bank_details' => null,
                'instructions' => 'Send USDT (TRC20 or ERC20) to the address shown. Ensure correct network selection.',
                'is_active' => false,
                'sort_order' => 3,
            ],
            [
                'name' => 'Bank Transfer',
                'type' => 'bank',
                'icon' => 'fas fa-university',
                'wallet_address' => null,
                'bank_details' => null,
                'instructions' => 'Transfer funds to the bank details provided. Include your user ID as reference.',
                'is_active' => false,
                'sort_order' => 4,
            ],
        ];

        foreach ($methods as $method) {
            PaymentMethod::updateOrCreate(
                ['name' => $method['name']],
                $method
            );
        }
    }
}
