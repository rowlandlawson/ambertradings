<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user'); // user, admin
            $table->decimal('balance', 15, 2)->default(0);
            $table->decimal('total_invested', 15, 2)->default(0);
            $table->decimal('total_profit', 15, 2)->default(0);
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'balance',
                'total_invested', 
                'total_profit',
                'phone',
                'country',
                'avatar',
                'is_active'
            ]);
        });
    }
};
