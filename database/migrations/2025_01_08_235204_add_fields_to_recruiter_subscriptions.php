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
        Schema::table('recruiter_subscriptions', function (Blueprint $table) {
            //
            $table->string('company_id')->nullable();
            $table->string('next_billing')->nullable();
            $table->string('currency')->nullable();
            $table->string('trans_id')->nullable();
            $table->string('payment_ref')->nullable();
            $table->string('card_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recruiter_subscriptions', function (Blueprint $table) {
            $table->dropColumn(['company_id', 'next_billing', 'currency', 'trans_id', 'payment_ref', 'card_info']);
        });
    }
};
