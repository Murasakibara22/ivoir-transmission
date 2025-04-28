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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->json('snapshot_reservation')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->json('snapshot_users')->nullable();
            $table->integer('montant');
            $table->string('methode');
            $table->string('status')->default('EN ATTENTE');
            $table->string('reference')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
