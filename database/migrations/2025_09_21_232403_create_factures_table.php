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
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->unique();
            $table->string('libelle');
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('PENDING');
            $table->string('email_customer')->nullable();
            $table->string('contact_customer')->nullable();
            $table->string('name_customer')->nullable();
            $table->decimal('montant', 10, 2)->default(0);
            $table->foreignId('entreprise_id')->nullable();
            $table->foreignId('fournisseur_id')->nullable();
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
