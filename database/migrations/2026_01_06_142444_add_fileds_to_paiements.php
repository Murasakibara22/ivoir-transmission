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
        Schema::table('paiements', function (Blueprint $table) {
            $table->foreignId('garage_id')->constrained()->onDelete('cascade');
            $table->foreignId('abonnement_id')->nullable()->constrained();
            $table->foreignId('reservation_id')->nullable()->change();
            $table->enum('type', ['deploiement', 'abonnement', 'reservation'])->default('reservation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn(['garage_id', 'abonnement_id', 'type']);
        });
    }
};
