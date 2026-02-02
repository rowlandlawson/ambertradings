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
        Schema::create('investment_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('min_amount', 15, 2);
            $table->decimal('max_amount', 15, 2);
            $table->decimal('roi_percentage', 8, 2); // Return on Investment %
            $table->integer('duration_days'); // Investment duration
            $table->string('risk_level')->default('medium'); // low, medium, high
            $table->boolean('is_active')->default(true);
            $table->string('icon')->nullable(); // Icon class or path
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investment_packages');
    }
};
