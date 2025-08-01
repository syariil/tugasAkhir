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
        Schema::table('tims', function (Blueprint $table) {
            // Change the type of whatsapp column from bigint to string
            $table->string('no_whatsapp')->change();
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tims', function (Blueprint $table) {
            // Revert the type of no_whatsapp column back to bigint
            $table->bigInteger('no_whatsapp')->change();
            //
        });
    }
};
