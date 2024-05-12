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
        Schema::create('decks_cards', function (Blueprint $table) {
            $table->uuid('deck_id');
            $table->uuid('card_id');
            $table->integer('count')->default(0);

            $table->primary(['deck_id', 'card_id']);
            $table->foreign('deck_id')->references('id')->on('decks')->onDelete('cascade');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('decks_cards');
    }
};
