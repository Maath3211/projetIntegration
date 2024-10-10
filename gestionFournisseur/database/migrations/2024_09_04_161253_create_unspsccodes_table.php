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
        Schema::create('unspsccodes', function (Blueprint $table) {
            $table->id();
            $table->string('details',500);
            $table->unsignedBigInteger('idUnspsc');
            $table->foreign('idUnspsc')->references('id')->on('unspsc')->onDelete('cascade');
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
        Schema::dropIfExists('unspsccodes');
    }
};
