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
            $table->string('verification_code')->nullable()->after('password');
            $table->timestamp('verification_expires_at')->nullable()->after('verification_code');
            $table->string('reset_code')->nullable()->after('verification_expires_at');
            $table->timestamp('reset_expires_at')->nullable()->after('reset_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['verification_code', 'verification_expires_at', 'reset_code', 'reset_expires_at']);
        });
    }
};
