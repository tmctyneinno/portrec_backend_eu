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
        Schema::create('application_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->nullable();
            $table->foreignId('job_id')->nullable();
            $table->text('questions')->nullable();
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_questions');
    }
};
