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
        Schema::create('cards', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('supertype')->nullable();
            $table->string('type');
            $table->string('subtype')->nullable();
            $table->integer('hp')->nullable();
            $table->uuid('set_id');
            $table->string('image_small_url')->nullable();
            $table->string('image_large_url')->nullable();

            $table->foreign('set_id')->references('id')->on('card_sets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
