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
        Schema::create('user', function (Blueprint $table) {
            $table->increments("id");
            $table->string("first_name");
            $table->string("last_name");
            $table->date("birth_date");
            $table->boolean("is_student");
            $table->string("email");
            $table->string("password");
            $table->string("phone");
            $table->integer("membership");
            $table->boolean("is_admin");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
