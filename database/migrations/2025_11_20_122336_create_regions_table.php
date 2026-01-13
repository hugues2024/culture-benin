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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_region')->unique();
            $table->string('description_region')->nullable();
            $table->integer('population');
            $table->string('localisation');
            $table->double('superficie');
            $table->timestamps();
            // NOUVEAUX ATTRIBUTS
            $table->integer('prix')->default(100); // Prix d'accès à la région
            $table->string('img')->default('img/regions/default.jpg'); // Chemin de l'image
            $table->boolean('paye')->default(false); // État du paiement
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
