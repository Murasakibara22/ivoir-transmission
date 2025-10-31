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
         Schema::create('alertes_maintenance', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicule_id');
            $table->unsignedBigInteger('entreprise_id');
            $table->string('type_alerte', 100); // 'kilometrage', 'date', 'controle_technique'
            $table->string('priorite', 50)->default('NORMAL'); // URGENT, IMPORTANT, NORMAL
            $table->text('message');
            $table->date('date_alerte');
            $table->string('status', 50)->default('ACTIVE'); // ACTIVE, RESOLVED, IGNORED
            $table->boolean('lue')->default(false);
            $table->timestamps();

            // Foreign keys
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('cascade');
            $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('cascade');

            // Index pour optimiser les requêtes
            $table->index(['entreprise_id', 'status', 'lue']);
            $table->index(['vehicule_id', 'status']);
            $table->index('date_alerte');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::dropIfExists('alertes_maintenance');
    }
};
