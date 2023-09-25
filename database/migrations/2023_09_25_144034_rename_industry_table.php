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
        Schema::rename("industries", "categories");

        $data = [
            ["name" => "design"],
            ["name" => "sales"],
            ["name" => "marketing"],
            ["name" => "business"],
            ["name" => "human resource"],
            ["name" => "finance"],
            ["name" => "engineering"],
            ["name" => "technology"],
        ];

        DB::table("categories")->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
