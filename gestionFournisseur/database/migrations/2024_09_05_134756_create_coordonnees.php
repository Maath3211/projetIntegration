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
            $table->string('noCivic', 8);
            $table->string('rue', 64);
            $table->string('bureau', 8)->nullable();
            $table->string('ville', 64);
            $table->string('province', 64);
            $table->string('codePostal', 6);
            $table->string('codeRegion', 2)->nullable();
            $table->string('nomRegion', 64)->nullable();
            $table->string('site', 64)->nullable();
            $table->string('typeTel', 64);
            $table->string('numero', 10);
            $table->string('poste', 6)->nullable();
            $table->string('typeTel2', 64)->nullable();
            $table->string('numero2', 10)->nullable();
            $table->string('poste2', 6)->nullable();
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
