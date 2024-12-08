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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_timA')->references('id')->on('tims')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_timB')->references('id')->on('tims')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('scoreA');
            $table->integer('scoreB');
            $table->enum('statusA', ['win', 'lose'])->nullable();
            $table->enum('statusB', ['win', 'lose'])->nullable();
            $table->integer('day');
            $table->time('time');
            $table->date('date');
            $table->string('babak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
