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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('recruiter_id')->constrained();
            $table->foreignId('application_id')->constrained();
            $table->string('assigned_to')->nullable();
            $table->string('channel')->nullable();
            $table->string('location')->nullable();
            $table->dateTime('interview_date')->nullable();
            $table->string('status')->nullable();
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
