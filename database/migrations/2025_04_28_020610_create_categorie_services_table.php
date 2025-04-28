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
        Schema::create('categorie_services', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('description')->nullable();
            $table->integer('frais_service')->nullable(); // au cas ou on ne remplit pas le champs du service il prend celui si s'il existe
            $table->string('logo')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorie_services');
    }
};
