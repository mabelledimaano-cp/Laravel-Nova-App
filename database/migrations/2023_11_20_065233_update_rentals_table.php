<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->change();
            $table->string('proof_of_payment')->nullable()->change();
            $table->string('reference_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropColumn('payment_method');
            $table->dropColumn('proof_of_payment');
            $table->dropColumn('reference_number');
        });
    }
};