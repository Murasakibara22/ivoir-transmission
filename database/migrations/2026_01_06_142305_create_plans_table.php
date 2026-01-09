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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Gratuit, Starter, Pro
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('prix_mensuel', 10, 2);
            $table->decimal('prix_annuel', 10, 2);
            $table->integer('limite_reservations')->nullable(); // null = illimité
            $table->integer('limite_admins')->nullable();
            $table->boolean('white_label')->default(false);
            $table->boolean('module_entreprise')->default(false);
            $table->boolean('api_access')->default(false);
            $table->boolean('support_prioritaire')->default(false);
            $table->boolean('actif')->default(true);
            $table->integer('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
