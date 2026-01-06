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
        Schema::table('vehicules', function (Blueprint $table) {
            $table->date('date_prochaine_visite')->nullable()->after('description');
            $table->decimal('cout_vidange_estime', 10, 2)->default(0.00)->after('date_prochaine_visite');
            $table->integer('kilometrage_actuel')->default(0)->after('cout_vidange_estime');
            $table->string('carburant', 50)->nullable()->after('kilometrage_actuel');
            $table->string('couleur', 50)->nullable()->after('carburant');
            $table->date('date_mise_circulation')->nullable()->after('couleur');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicules', function (Blueprint $table) {
            $table->dropColumn([
                'date_prochaine_visite',
                'cout_vidange_estime',
                'kilometrage_actuel',
                'carburant',
                'couleur',
                'date_mise_circulation'
            ]);
        });
    }
};
