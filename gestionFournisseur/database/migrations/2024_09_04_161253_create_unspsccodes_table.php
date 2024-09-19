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
            $table->integer('idUser');
            $table->foreignId('idUnspsc')->constrained('Unspsc');
            $table->string('details',500);
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
