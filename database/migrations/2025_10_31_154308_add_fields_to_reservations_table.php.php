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
        Schema::table('reservations', function (Blueprint $table) {
            // Ajout de la colonne vehicule_id si elle n'existe pas déjà
            if (!Schema::hasColumn('reservations', 'vehicule_id')) {
                $table->unsignedBigInteger('vehicule_id')->nullable()->after('user_id');
                $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('set null');
            }

            $table->string('type_maintenance', 100)->nullable()->after('category');
            $table->decimal('cout_reel', 10, 2)->nullable()->after('montant');
            $table->text('notes_mecanicien')->nullable()->after('description');
            $table->boolean('rappel_envoye')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['vehicule_id']);
            $table->dropColumn([
                'vehicule_id',
                'type_maintenance',
                'cout_reel',
                'notes_mecanicien',
                'rappel_envoye'
            ]);
        });
    }
};
