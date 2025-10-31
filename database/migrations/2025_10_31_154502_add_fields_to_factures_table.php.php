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
            $table->unsignedBigInteger('vehicule_id')->nullable()->after('entreprise_id');
            $table->unsignedBigInteger('reservation_id')->nullable()->after('vehicule_id');
            $table->string('fichier_pdf')->nullable()->after('date');
            $table->date('date_echeance')->nullable()->after('date');
            $table->decimal('tva', 10, 2)->default(0.00)->after('montant');
            $table->decimal('montant_ttc', 10, 2)->default(0.00)->after('tva');

            // Foreign keys
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('set null');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factures', function (Blueprint $table) {
            $table->unsignedBigInteger('vehicule_id')->nullable()->after('entreprise_id');
            $table->unsignedBigInteger('reservation_id')->nullable()->after('vehicule_id');
            $table->string('fichier_pdf')->nullable()->after('date');
            $table->date('date_echeance')->nullable()->after('date');
            $table->decimal('tva', 10, 2)->default(0.00)->after('montant');
            $table->decimal('montant_ttc', 10, 2)->default(0.00)->after('tva');

            // Foreign keys
            $table->foreign('vehicule_id')->references('id')->on('vehicules')->onDelete('set null');
            $table->foreign('reservation_id')->references('id')->on('reservations')->onDelete('set null');
        });
    }
};
