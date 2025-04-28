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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('montant');
            $table->string('status')->default('PENDING');
            $table->string('status_paiement')->default('PENDING');
            $table->text('description')->nullable();
            $table->json('images')->nullable();
            $table->string('adresse_name');
            $table->json('location')->nullable();
            $table->dateTime('date_debut');
            $table->dateTime('start_at')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade');
            $table->json('snapshot_services')->nullable();
            $table->json('snapshot_users')->nullable();
            $table->json('snapshot_vehicule')->nullable();
            $table->string('slug')->unique();
            $table->string('name_prestataire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
