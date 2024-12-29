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
        Schema::table('user_subscriptions', function (Blueprint $table) {
            //
            $table->string('trans_id')->nullable();
            $table->string('payment_ref')->nullable();
            $table->string('card_info')->nullable();
            $table->string('next_billing')->nullable();
            $table->string('currency')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_subscriptions', function (Blueprint $table) {
            //
        });
    }
};
