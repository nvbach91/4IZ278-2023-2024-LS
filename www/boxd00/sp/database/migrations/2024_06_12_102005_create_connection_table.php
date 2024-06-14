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
        Schema::create('connection', function (Blueprint $table) {
            $table->string("flight_code")->primary();
            $table->string("from_code");
            $table->string("to_code");
            $table->integer("day");
            $table->time("time");
            $table->integer("duration");
            $table->integer("price");
            $table->timestamps();

            $table->foreign("from_code")->references("airport_code")->on("destination");
            $table->foreign("to_code")->references("airport_code")->on("destination");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connection');
    }
};
