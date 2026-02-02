<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@ambertradings.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'balance' => 0,
                'total_invested' => 0,
                'total_profit' => 0,
                'is_active' => true,
            ]
        );

        $this->command->info('Admin user created:');
        $this->command->info('Email: admin@ambertradings.com');
        $this->command->info('Password: admin123');
        $this->command->warn('Please change the password after first login!');
    }
}
