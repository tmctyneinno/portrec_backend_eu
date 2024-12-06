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
        Schema::table('interviews', function (Blueprint $table) {
            //

            $table->longText('description')->nullable();
            $table->text('team_members')->nullable();
            $table->string('password')->nullable();
            $table->string('meeting_id')->nullable();
            $table->string('join_url')->nullable();
            $table->string('host_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interviews', function (Blueprint $table) {
            $table->dropColumn(['description', 'team_members', 'password', 'join_url', 'host_id']);
        });
    }
};
