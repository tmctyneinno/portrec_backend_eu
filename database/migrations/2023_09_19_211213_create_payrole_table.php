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
        Schema::create('payroles', function (Blueprint $table) {
            $table->id();
            $table->string("employee_id");
            $table->string("basic_salary");
            $table->string("house_rent_allowance");
            $table->string("tax");
            $table->string("load");
            $table->string("allowance");
            $table->string("others");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payroles');
    }
};
