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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('company_name')->nullable();
            $table->string('company_location')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('job_title')->nullable();
            $table->string('job_level')->nullable();
            $table->foreignId('industries_id')->nullable();
            $table->foreignId('job_function_id')->constrained();
            $table->string('salary_range')->nullable();
            $table->foreignId('work_type_id')->constrained();
            $table->text('description')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
