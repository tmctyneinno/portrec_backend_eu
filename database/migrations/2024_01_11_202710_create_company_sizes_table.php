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
        Schema::create('company_sizes', function (Blueprint $table) {
                $table->id();
                $table->string("name");
                $table->string("min");
                $table->string("max");
                $table->timestamps();
            });
    
            $data = [
                ["name" => "1-50", "min" => "1", "max" => "50"],
                ["name" => "51-150", "min" => "51", "max" => "150"],
                ["name" => "151-250", "min" => "151", "max" => "250"],
                ["name" => "251-500", "min" => "251", "max" => "500"],
                ["name" => "501-1000", "min" => "501", "max" => "1000"],
                ["name" => "1001-above", "min" => "1001", "max" => "10000000"],
            ];
            DB::table("company_sizes")->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_sizes');
    }
};
