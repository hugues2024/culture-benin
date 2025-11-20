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
        Schema::create('parlers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_langue')->constrained('langues');
            $table->foreignId('id_region')->constrained('regions');
            $table->unique(['id_langue', 'id_region']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('parlers');
        Schema::enableForeignKeyConstraints();
    }
};
