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
        Schema::create('coordonnees', function (Blueprint $table) {
            $table->id();
            $table->string('noCivic', 255);
            $table->string('rue', 255);
            $table->string('bureau', 255);
            $table->string('ville', 255);
            $table->string('province', 255);
            $table->string('codePostal', 255);
            /*$table->string('codeRegion', 255);*/
            /*$table->string('nomRegion', 255);*/
            $table->string('site', 255);
            $table->string('typeTel', 255);
            $table->string('numero', 255);
            $table->string('poste', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordonnees');
    }
};
