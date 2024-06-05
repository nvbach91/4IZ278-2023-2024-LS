<?php

use App\Models\User;
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
        Schema::table('cats', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->foreignId('owner_id')
                ->change()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::table('available_times', function (Blueprint $table) {
            $table->dropForeign(['sitter_id']);
            $table->foreignId('sitter_id')
                ->change()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['sitting_id']);
            $table->foreignId('sitting_id')
                ->change()
                ->constrained('sittings')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::table('sittings', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['sitter_id']);
            $table->foreignId('owner_id')
                ->nullable()
                ->change()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->foreignId('sitter_id')
                ->nullable()
                ->change()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->foreignId('owner_id')->change()->constrained('users');
        });

        Schema::table('available_times', function (Blueprint $table) {
            $table->dropForeign(['sitter_id']);
            $table->foreignId('sitter_id')->change()->constrained('users');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['sitting_id']);
            $table->foreignId('sitting_id')->change()->constrained('sittings');
        });

        Schema::table('sittings', function (Blueprint $table) {
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['sitter_id']);
        });
        Schema::table('sittings', function (Blueprint $table) {
            $table->foreignId('owner_id')->nullable(false)->change()->constrained('users');
            $table->foreignId('sitter_id')->nullable(false)->change()->constrained('users');
        });
    }
};
