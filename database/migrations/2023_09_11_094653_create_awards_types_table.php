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
        Schema::create('award_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamp("deleted_at")->nullable();
            $table->timestamps();
        });

        $awards = [
            ["name" => "award"],
            ["name" => "certificate"],
            ["name" => "license"]
        ];

        DB::table('award_types')->insert($awards);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards_types');
    }
};
