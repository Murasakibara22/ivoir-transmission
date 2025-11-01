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
        Schema::create('entretiens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contrat_id')->constrained('contrats')->onDelete('cascade');
            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');

            // Planning
            $table->date('date_prevue'); // Quand l'entretien est prévu
            $table->date('date_realisation')->nullable(); // Quand il a été fait
            $table->integer('numero_entretien'); // 1er, 2ème, 3ème entretien du contrat

            // Véhicules
            $table->integer('nombre_vehicules_total'); // Copié du contrat
            $table->integer('nombre_vehicules_fait')->default(0);
            $table->integer('nombre_vehicules_restant'); // Calculé

            // Coûts
            $table->decimal('cout_prevu', 10, 2); // Montant initial du contrat
            $table->decimal('cout_final', 10, 2)->nullable(); // Montant ajusté si modification
            $table->text('commentaire_cout')->nullable(); // Justification si changement

            // Statut workflow
            $table->enum('status', ['PENDING', 'IN_PROGRESS', 'COMPLETED', 'CANCELLED'])->default('PENDING');

            // Notes générales
            $table->text('notes')->nullable();
            $table->string('slug')->unique();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entretiens');
    }
};
