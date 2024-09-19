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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->text('prenom',32);
            $table->text('nom',32);
            $table->text('fonction',32);
            $table->text('courriel',64);
            $table->text('typeTelephone',12);
            $table->text('telephone',10);
            $table->text('poste',6)->nullable();
            $table->foreignId('fournisseur')->constrained('fournisseurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};