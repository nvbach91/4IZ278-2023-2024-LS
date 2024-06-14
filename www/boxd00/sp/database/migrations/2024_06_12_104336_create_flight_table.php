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
        Schema::create('flight', function (Blueprint $table) {
            // $table->id();
            $table->increments("id");
            $table->string("flight_code");
            $table->integer("delay");
            $table->date("date");
            $table->timestamps();

            $table->foreign("flight_code")->references("flight_code")->on("connection");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight');
    }
};
