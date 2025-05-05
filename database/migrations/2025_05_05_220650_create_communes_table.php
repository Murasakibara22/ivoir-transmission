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
        Schema::create('communes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ville_id')->constrained('villes')->onDelete('cascade');
            $table->string('nom');
            $table->json('jours')->nullable();
            $table->string('frais_service')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('communes');
    }
};
