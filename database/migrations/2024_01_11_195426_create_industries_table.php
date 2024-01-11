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
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('status')->default(0);
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });

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

        DB::table("industries")->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('industries');
    }
};
