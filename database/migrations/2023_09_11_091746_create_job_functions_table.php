<?php

use Illuminate\Support\Facades\DB;
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
        Schema::create('job_functions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('industries_id');
            // $table->foreignId('industries_id')->constrained();
            $table->string('name')->nullable();
            $table->timestamps();
        });

        $data = [
            "industries_id" => "1",
            "name" => "Fullstack Developer"
        ];
        DB::table('job_functions')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_functions');
    }
};
