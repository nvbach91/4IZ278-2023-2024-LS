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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active');
            $table->float('fee');
            $table->timestamps();
        });
        Schema::create('users_clients', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('client_id')->constrained('clients');
            $table->boolean('owner');
            $table->timestamps();
        });
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->constrained('clients');
            $table->string('number');
            $table->integer('sequence')->nullable();
            $table->timestamps();
        });
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->foreignId('account_id')->constrained('accounts');
            $table->timestamps();
        });
        Schema::create('sequences', function (Blueprint $table) {
            $table->id();
            $table->string('generator');
            $table->string('last_used');
            $table->timestamps();
        });
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hash');
            $table->boolean('active');
            $table->foreignId('client_id')->constrained('clients');
            $table->timestamps();
        });
        Schema::create('generated', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->string('variable_symbol');
            $table->foreignId('seller_id')->constrained('sellers');
            $table->foreignId('account_id')->constrained('accounts');
            $table->boolean('success');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generated');
        Schema::dropIfExists('sellers');
        Schema::dropIfExists('sequences');
        Schema::dropIfExists('api_keys');
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('users_clients');
        Schema::dropIfExists('clients');
    }
};
