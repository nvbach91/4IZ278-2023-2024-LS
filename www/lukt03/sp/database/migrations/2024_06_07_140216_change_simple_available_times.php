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
        Schema::table('available_times', function (Blueprint $table) {
            $table->dropColumn('rfc5545_str');
            $table->timestamp('start')->useCurrent();
            $table->timestamp('end')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('available_times', function (Blueprint $table) {
            $table->dropColumn(['start', 'end']);
            $table->string('rfc5545_str');
        });
    }
};
