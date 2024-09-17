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
            $table->string('licenceRBQ',100);
            $table->string('statut',100);
            $table->string('typeLicence',100);
            $table->foreignId('idCategorie')->constrained('Categories');
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
