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
            $table->date('date_debut')->nullable()->after('description');
            $table->date('date_fin')->nullable()->after('date_debut');
            $table->decimal('montant_total', 10, 2)->default(0.00)->after('date_fin');
            $table->integer('nombre_vehicules')->default(0)->after('montant_total');
            $table->string('frequence_paiement', 50)->nullable()->after('nombre_vehicules'); // mensuel, trimestriel, annuel
            $table->string('fichier_contrat_pdf')->nullable()->after('status');

            // Ajout du slug s'il n'existe pas
            if (!Schema::hasColumn('contrats', 'slug')) {
                $table->string('slug')->unique()->after('fichier_contrat_pdf');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contrats', function (Blueprint $table) {
            $table->dropColumn([
                'date_debut',
                'date_fin',
                'montant_total',
                'nombre_vehicules',
                'frequence_paiement',
                'fichier_contrat_pdf',
                'slug'
            ]);
        });
    }
};
