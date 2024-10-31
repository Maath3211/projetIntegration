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
        Schema::create('RBQLicences', function (Blueprint $table) {
            $table->id();
            $table->string('licenceRBQ',10)->default('Rien');
            $table->string('statut',25)->default('Rien');
            $table->string('typeLicence',250)->default('Rien');
            $table->foreignId('idCategorie')->nullable()->constrained('categories');
            $table->unsignedBigInteger('fournisseur_id');
            $table->foreign('fournisseur_id')->references('id')->on('fournisseurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('RBQLicences');
    }
};
