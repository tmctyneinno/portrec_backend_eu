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
        Schema::create('job_openings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained();
            $table->foreignId("company_id")->constrained();
            $table->string('title')->nullable();
            $table->string('job_functions')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('location')->nullable();
            $table->string("work_type_id")->constrained();
            $table->text("experience");
            $table->double('min_salary')->nullable();
            $table->double('max_salary')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string("title");
            $table->text("description");
            $table->integer("total_view")->default(0);
            $table->string("required_skills");
            $table->text("other_qualification")->nullable();
            $table->json("benefits")->nullable();
            $table->timestamps();
            // $table->string("employment_type_id");
            // $table->string("category_id");
            // $table->text("responsibilities");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_openings');
    }
};
