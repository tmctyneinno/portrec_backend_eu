<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_types', function (Blueprint $table) {
            $table->id(); //Full time, part-time, hybrid
            $table->string('name')->nullable();
            $table->integer('status')->nullable();
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });

        $data = [
            ["name" => "full-time"],
            ["name" => "part-time"],
            ["name" => "remote"],
            ["name" => "internship"],
            ["name" => "contract"],
        ];
        DB::table("job_types")->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_types');
    }
};
