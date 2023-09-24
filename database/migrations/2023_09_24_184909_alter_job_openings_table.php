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
        Schema::table("job_openings", function (Blueprint $table) {
            $table->foreignId('recruiter_id')->constrained();
            $table->foreignId("company_id")->constrained();
            $table->string("job_type_id")->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
