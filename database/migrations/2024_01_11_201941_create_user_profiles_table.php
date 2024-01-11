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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('job_function_id')->constrained();
            $table->string('user_level_id')->nullable();
            $table->string("industries_id")->nullable();
            $table->string('job_type_id')->nullable();
            $table->string("language_id")->nullable();
            $table->string('image_path')->nullable();
            $table->string('phone')->nullable();
            $table->integer('availability_id')->nullable();
            $table->text('preference')->nullable(); 
            $table->double('salary_expectation')->nullable();
            $table->string('gender_id')->nullable();
            $table->string('professional_headline')->nullable();
            $table->string('years_experience')->nullable();
            $table->string('experience_level')->nullable();
            $table->string('dob')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->text("address")->nullable();
            $table->string('allow_search')->nullable();
            $table->text('description')->nullable();
            $table->string("linkedin")->nullable();
            $table->string("twitter")->nullable();
            $table->string("facebook")->nullable();
            $table->string("avatar")->nullable();
            $table->string('googleplus')->nullable();
            $table->string('location')->nullable();
            $table->text("about_me")->nullable();
            $table->text("skills")->nullable();
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
