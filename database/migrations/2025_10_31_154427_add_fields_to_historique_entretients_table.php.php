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
            $table->unsignedBigInteger('reservation_id')->nullable()->after('id');
            $table->integer('kilometrage_intervention')->nullable()->after('date_entretient');
            $table->integer('prochain_entretien_km')->nullable()->after('kilometrage_intervention');
            $table->date('prochain_entretien_date')->nullable()->after('prochain_entretien_km');
            $table->string('facture_pdf')->nullable()->after('montant');

            // Foreign key
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('historique_entretients', function (Blueprint $table) {
            $table->dropForeign(['reservation_id']);
            $table->dropColumn([
                'reservation_id',
                'kilometrage_intervention',
                'prochain_entretien_km',
                'prochain_entretien_date',
                'facture_pdf'
            ]);
        });
    }
};
