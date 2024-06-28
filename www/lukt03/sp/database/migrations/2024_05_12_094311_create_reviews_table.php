n<?php

use App\Models\Sitting;
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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Sitting::class, 'sitting_id')->constrained();
            $table->string('review_of_owner', 1000)->nullable();
            $table->integer('score_of_owner')->nullable();
            $table->string('review_of_sitter', 1000)->nullable();
            $table->integer('score_of_sitter')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
