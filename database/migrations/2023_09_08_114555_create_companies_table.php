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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('recruiter_id')->constrained();
            $table->string('industry_id')->nullable();
            $table->string('name')->nullable();
            $table->string('cac')->nullable();
            $table->integer('company_type_id')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            // $table->string("name");
            // $table->string("email")->unique();
            // $table->string("website")->unique()->nullable();
            // $table->string("about")->unique()->nullable();
            // $table->string("locations")->nullable();
            // $table->string("employee")->nullable();
            // $table->string("date_founded")->nullable();
            // $table->string("industry")->nullable();
            // $table->string("tech_stack")->nullable();
            // $table->string("tech_stack")->nullable();
            // $table->text("instagram")->nullable();
            // $table->text("twitter")->nullable();
            // $table->text("facebook")->nullable();
            // $table->text("youtube")->nullable();
            // $table->text("linkdin")->nullable();
            // $table->string("logo")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
