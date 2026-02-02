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
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('investment_package_id')->nullable()->constrained()->onDelete('set null');
            $table->string('type'); // crypto, forex, stocks, etc.
            $table->decimal('amount', 15, 2);
            $table->decimal('profit', 15, 2)->default(0);
            $table->decimal('roi_percentage', 8, 2)->default(0);
            $table->string('status')->default('active'); // pending, active, completed, cancelled
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('investments');
    }
};
