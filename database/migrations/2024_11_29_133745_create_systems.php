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
        Schema::create('systems', function (Blueprint $table) {
            $table->id();
            $table->string('banner')->nullable()->default('logo.png');
            $table->string('playoff_banner')->nullable();
            $table->boolean('schedule')->nullable()->default(true);
            $table->enum('babak', ['playoff', 'regular'])->default('regular');
            $table->boolean('registration')->default(true);
            $table->integer('season')->nullable();
            $table->integer('poin')->nullable();
            $table->string('bank')->nullable();
            $table->bigInteger('no_rek')->nullable();
            $table->integer('fee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('systems');
    }
};
