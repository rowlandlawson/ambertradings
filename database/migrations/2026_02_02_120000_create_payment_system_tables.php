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
        // Payment methods table - stores wallet addresses configured by admin
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Bitcoin, Ethereum, USDT, Bank Transfer
            $table->string('type'); // crypto, bank
            $table->string('icon')->nullable(); // fa icon class
            $table->string('wallet_address')->nullable(); // For crypto
            $table->text('bank_details')->nullable(); // JSON for bank info
            $table->text('instructions')->nullable(); // Additional instructions
            $table->boolean('is_active')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Deposit requests table - stores user deposit requests with receipts
        Schema::create('deposit_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('receipt_image'); // Path to uploaded receipt
            $table->string('status')->default('pending'); // pending, approved, rejected
            $table->text('admin_notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->foreignId('processed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_requests');
        Schema::dropIfExists('payment_methods');
    }
};
