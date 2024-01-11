<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('job_levels', function (Blueprint $table) {
            $table->id();
                $table->string('name')->nullable();
                $table->integer("status")->nullable();
                $table->timestamps();
            });
    
            $data = [
                ["name" => "entry level"],
                ["name" => "mid level"],
                ["name" => "senior level"],
                ["name" => "director"],
                ["name" => "vp & above"],
            ];
            DB::table("job_levels")->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_levels');
    }
};
