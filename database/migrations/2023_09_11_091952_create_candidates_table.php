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
        Schema::create('candidates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->integer('work_type_id')->nullable();
            $table->string('location')->nullable();
            // $table->string('location');
            $table->string('image_path')->nullable();
            $table->string('phone')->nullable();
            $table->integer('availability_id')->nullable();
            $table->text('preference')->nullable();
            $table->double('salary_expectation')->nullable();
            $table->string('language_id')->nullable();
            $table->foreignId('job_function_id')->constrained();
            $table->string('gender_id')->nullable();
            $table->string('professional_headline')->nullable();
            $table->string('years_experience')->nullable();
            $table->string('experience_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
