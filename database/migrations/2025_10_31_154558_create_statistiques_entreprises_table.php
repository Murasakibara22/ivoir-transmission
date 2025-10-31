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
       Schema::create('statistiques_entreprise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('entreprise_id');
            $table->integer('mois');
            $table->integer('annee');
            $table->integer('nombre_interventions')->default(0);
            $table->decimal('cout_total', 10, 2)->default(0.00);
            $table->integer('nombre_vehicules_actifs')->default(0);
            $table->timestamps();

            // Foreign key
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');

            // Contrainte unique pour éviter les doublons
            $table->unique(['entreprise_id', 'mois', 'annee'], 'unique_entreprise_mois_annee');

            // Index pour optimiser les requêtes
            $table->index(['entreprise_id', 'annee', 'mois']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistiques_entreprises');
    }
};
