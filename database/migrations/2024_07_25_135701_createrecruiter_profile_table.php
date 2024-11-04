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
        Schema::create('recruiter_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained();
            $table->string('company_id')->nullable();
            $table->string('recruiter_level_id')->nullable();
            $table->string('image_path')->nullable();
            $table->string('phone')->nullable();
            $table->integer('availability_id')->nullable();
            $table->string('gender_id')->nullable();
            $table->string('professional_headline')->nullable();
            $table->string('dob')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->text("address")->nullable();
            $table->text('description')->nullable();
            $table->integer('avatar')->nullable();
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
