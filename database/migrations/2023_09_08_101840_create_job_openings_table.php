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
            $table->foreignId("company_id")->references("id")->on("companies")->onDelete("cascade");
            $table->string("employment_type_id");
            $table->string("type_id");
            $table->string("salary_range")->nullable();
            $table->string("category_id");
            $table->integer("total_view")->default(0);
            $table->string("required_skills");
            $table->text("job_description");
            $table->text("responsibilities");
            $table->text("qaulifications");
            $table->text("other_qualification")->nullable();
            $table->json("benefits")->nullable();
            $table->timestamps();
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
