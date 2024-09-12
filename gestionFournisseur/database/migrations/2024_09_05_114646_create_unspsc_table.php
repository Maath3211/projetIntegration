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
        Schema::create('unspsc', function (Blueprint $table) {
            $table->id();
            $table->string('nature',200)->nullable();
            $table->string('code_categorie',150)->nullable();
            $table->string('categorie',300)->nullable();
            $table->integer('code')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unspsc');
    }
};
