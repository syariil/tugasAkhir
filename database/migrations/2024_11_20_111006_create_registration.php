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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('leader');
            $table->bigInteger('no_whatsapp');
            $table->string('squad');
            $table->string('short_squad');
            $table->string('logo')->default("logo.png");
            $table->string('fee');


            $table->string('nickname1');
            $table->bigInteger('id_nickname1');
            $table->string('nickname2');
            $table->bigInteger('id_nickname2');
            $table->string('nickname3');
            $table->bigInteger('id_nickname3');
            $table->string('nickname4');
            $table->bigInteger('id_nickname4');
            $table->string('nickname5');
            $table->bigInteger('id_nickname5');
            $table->string('nickname6')->nullable();
            $table->bigInteger('id_nickname6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
