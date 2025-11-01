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
        Schema::table('factures', function (Blueprint $table) {

            $table->foreignId('entretien_id')->constrained('entretiens')->onDelete('cascade');
            $table->foreignId('contrat_id')->nullable()->constrained()->onDelete('set null');

            $table->date('date_emission');

            $table->enum('status_paiement', ['PENDING', 'PAID', 'OVERDUE', 'CANCELLED'])->default('PENDING');
            $table->enum('moyen_paiement', ['VIREMENT', 'CHEQUE', 'ESPECES', 'CARTE', 'MOBILE_MONEY'])->nullable();
            $table->string('reference_paiement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->dropColumn(['entretien_id', 'contrat_id', 'date_emission', 'date_paiement', 'status_paiement', 'moyen_paiement', 'reference_paiement']);
        });
    }
};
