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
        Schema::table('historique_entretients', function (Blueprint $table) {
                $table->foreignId('entretien_id')->nullable()->constrained('entretiens')->onDelete('set null');
                $table->foreignId('contrat_id')->nullable()->constrained('contrats')->onDelete('set null');


                $table->json('pieces_changees')->nullable(); // Liste des pièces
                $table->json('services_effectues')->nullable(); // Liste des services
                $table->decimal('cout_pieces', 10, 2)->default(0);
                $table->decimal('cout_main_oeuvre', 10, 2)->default(0);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historique_entretients', function (Blueprint $table) {
            $table->dropColumn(['entretien_id', 'contrat_id', 'pieces_changees', 'services_effectues', 'cout_pieces', 'cout_main_oeuvre']);
        });
    }
};
