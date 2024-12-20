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
        Schema::create('fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->string('email', 64);
            $table->string('neq', 10)->unique()->nullable();
            $table->string('entreprise', 64);
            $table->string('password', 255); /* Plus grand pour encryptage */
            $table->string('statut')->default('En attente');
            $table->timestamp('dateStatut')->nullable();
            $table->string('raisonRefus', 255)->nullable();
            $table->string('codeReset', 60)->nullable();
            $table->timestamp('demandeReset')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
