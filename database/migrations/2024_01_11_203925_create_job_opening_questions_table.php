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
        Schema::create('job_opening_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained();
            $table->foreignId('job_opening_id')->constrained();
            $table->text('questions')->nullable();
            $table->text('answers')->nullable();
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_opening_questions');
    }
};
