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
        Schema::create('fournisseurs_equipements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade');
            $table->foreignId('equipement_id')->constrained('equipements')->onDelete('cascade');
            $table->integer('quantity')->default(0);
            $table->string('status')->default('AVAILABLE');
            $table->decimal('price_unit', 10, 2)->default(0);
            $table->decimal('price_total', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->date('delivery_date')->nullable();
            $table->integer('quantity_demander')->nullable();
            $table->integer('quantity_fourni')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs_equipements');
    }
};
