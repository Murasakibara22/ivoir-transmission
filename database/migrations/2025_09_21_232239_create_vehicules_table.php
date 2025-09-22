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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('libelle');
            $table->string('matricule')->unique();
            $table->string('type')->nullable();
            $table->string('marque')->nullable();
            $table->json('images')->nullable();
            $table->string('chassis')->nullable();
            $table->string('modele')->nullable();
            $table->string('status')->default('ACTIVATED');
            $table->string('year')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique();

            $table->foreignId('entreprise_id')->constrained('entreprises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
