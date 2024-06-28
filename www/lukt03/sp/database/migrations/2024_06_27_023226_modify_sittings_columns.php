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
        Schema::table('sittings', function (Blueprint $table) {
            $table->renameColumn('start_time', 'start');
            $table->renameColumn('end_time', 'end');
            $table->integer('status')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sittings', function (Blueprint $table) {
            $table->renameColumn('start', 'start_time');
            $table->renameColumn('end', 'end_time');
            $table->integer('status')->change();
        });
    }
};
