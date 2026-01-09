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
        Schema::create('garages', function (Blueprint $table) {
            $table->id();
            $table->string('nom_commercial');
            $table->string('slug')->unique(); // pour sous-domaine
            $table->string('email')->unique();
            $table->string('telephone');
            $table->text('adresse');
            $table->string('ville');
            $table->string('code_postal');
            $table->string('siret')->nullable();

            // White-label
            $table->string('logo_url')->nullable();
            $table->string('couleur_primaire')->default('#3B82F6');
            $table->string('couleur_secondaire')->default('#10B981');
            $table->string('sous_domaine')->unique()->nullable();

            // Abonnement
            $table->enum('status', ['essai', 'actif', 'suspendu', 'resilie'])->default('essai');
            $table->foreignId('plan_id')->nullable()->constrained('plans');
            $table->date('date_debut_abonnement')->nullable();
            $table->date('date_fin_abonnement')->nullable();
            $table->boolean('frais_deploiement_paye')->default(false);
            $table->decimal('frais_deploiement', 10, 2)->default(0);

            // Limites
            $table->integer('limite_reservations_mois')->default(10);
            $table->integer('limite_admins')->default(1);
            $table->boolean('acces_module_entreprise')->default(false);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garages');
    }
};
