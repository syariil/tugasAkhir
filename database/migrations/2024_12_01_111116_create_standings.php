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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_grup')->constrained()->onDelete('cascade')->onUpdate('cascade')->on('grups');
            $table->foreignId('id_tim')->constrained()->onDelete('cascade')->onUpdate('cascade')->on('tims');
            $table->integer('game')->nullable();
            $table->integer('win')->nullable();
            $table->integer('lose')->nullable();
            $table->integer('winrate')->nullable();
            $table->integer('poin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
