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
        Schema::create('ticket', function (Blueprint $table) {
            $table->increments("id");
            $table->unsignedBigInteger("flight_id");
            $table->unsignedBigInteger("passenger_id");
            $table->string("seat");
            $table->integer("class");
            $table->boolean("reserved"); // tinyint(1)?
            $table->timestamp("reserved_until");
            $table->timestamps();

            $table->foreign("flight_id")->references("id")->on("flight");
            $table->foreign("passenger_id")->references("id")->on("user");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
