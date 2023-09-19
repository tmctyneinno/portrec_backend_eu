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
            $table->string('title');
            $table->text("description");
            $table->string("required_skills");
            $table->string("job_type_id")->constrained();
            $table->double('min_salary')->nullable();
            $table->double('max_salary')->nullable();
            $table->string('job_functions')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->string('qualifications')->nullable();
            $table->string('location')->nullable();
            $table->text("experience");
            $table->integer("total_view")->default(0);
            $table->text("other_qualifications")->nullable();
            $table->json("benefits")->nullable();
            $table->json("status")->nullable();
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
