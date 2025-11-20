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
        Schema::create('contenus', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->text('texte')->nullable();
            $table->string('statut');

            $table->unsignedBigInteger('parent_id')->nullable()->index();
            $table->foreign('parent_id')->references('id')->on('contenus');

            $table->foreignId('region_id')->constrained();
            $table->foreignId('langue_id')->constrained();
            $table->foreignId('type_contenu_id')->constrained();

            //


            $table->foreignId('id_auteur')->nullable()->constrained('users');
            $table->foreignId('id_moderateur')->nullable()->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('contenus');
        Schema::enableForeignKeyConstraints();
    }
};
