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
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('counter_one')->nullable();
            $table->string('title_one')->nullable();

            $table->string('counter_two')->nullable();
            $table->string('title_two')->nullable();

            $table->string('counter_three')->nullable();
            $table->string('title_three')->nullable();

            $table->string('counter_four')->nullable();
            $table->string('title_four')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters');
    }
};
