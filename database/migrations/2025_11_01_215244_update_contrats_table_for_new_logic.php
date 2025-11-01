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
        Schema::table('contrats', function (Blueprint $table) {

             // NOUVEAUX CHAMPS
            $table->enum('frequence_entretien', ['MENSUEL', 'TRIMESTRIEL', 'SEMESTRIEL', 'ANNUEL']);
            $table->integer('duree_contrat_mois'); // Ex: 12 mois, 24 mois
            $table->date('date_premier_entretien'); // Première intervention prévue
            $table->decimal('montant_entretien', 10, 2); // Coût par entretien

            // Statuts et validation
            $table->timestamp('entreprise_validated_at')->nullable();
            $table->timestamp('garage_validated_at')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->dropColumn(['frequence_entretien', 'duree_contrat_mois', 'date_premier_entretien', 'montant_entretien', 'entreprise_validated_at', 'garage_validated_at']);
        });
    }
};
