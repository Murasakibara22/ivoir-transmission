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
            if (!Schema::hasColumn('reservations', 'entreprise_id')) {
                $table->unsignedBigInteger('entreprise_id')->nullable()->after('user_id');
                $table->foreign('entreprise_id')->references('id')->on('entreprises')->onDelete('set null');

                // Index pour optimiser les requêtes
                $table->index(['entreprise_id', 'status', 'date_debut']);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['entreprise_id']);
            $table->dropColumn('entreprise_id');
        });
    }
};
