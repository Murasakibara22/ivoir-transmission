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
            $table->dropForeign(['service_id']);
             $table->dropColumn('service_id');

            $table->foreignId('categorie_service_id')->nullable();
            $table->json('services_ids')->nullable()->comment('IDs des besoins sélectionnés');
            $table->json('snapshot_categorie')->nullable()->after('services_ids');
            $table->json('snapshot_services_selectionnes')->nullable()->after('snapshot_categorie');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['categorie_service_id']);
            $table->dropColumn('categorie_service_id');
            $table->dropColumn('services_ids');
            $table->dropColumn('snapshot_categorie');
            $table->dropColumn('snapshot_services_selectionnes');
        });
    }
};
