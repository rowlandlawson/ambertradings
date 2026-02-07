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
        Schema::table('investments', function (Blueprint $table) {
            $table->decimal('withdrawable_profit', 15, 2)->default(0)->after('profit');
            $table->decimal('loss', 15, 2)->default(0)->after('withdrawable_profit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn(['withdrawable_profit', 'loss']);
        });
    }
};
