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
        Schema::table('todos', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
            $table->dateTime('deadline')->nullable()->change();
            $table->time('deadline_time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todos', function (Blueprint $table) {
            $table->text('content')->nullable(false)->change();
            $table->dateTime('deadline')->nullable(false)->change();
            $table->time('deadline_time')->nullable(false)->change();
        });
    }
};
