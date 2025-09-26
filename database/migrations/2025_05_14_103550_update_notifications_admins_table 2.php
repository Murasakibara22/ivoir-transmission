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
        Schema::table('notification_admins', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();

            // Ajouter la colonne view_by comme une clé étrangère vers users
            $table->foreignId('view_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Ajouter la colonne view_at
            $table->timestamp('view_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notification_admins', function (Blueprint $table) {
             // Annuler les changements
             $table->foreignId('user_id')->nullable(false)->constrained('users')->cascadeOnDelete()->change();
             $table->dropForeign(['view_by']);
             $table->dropColumn('view_by');
             $table->dropColumn('view_at');
        });
    }
};
