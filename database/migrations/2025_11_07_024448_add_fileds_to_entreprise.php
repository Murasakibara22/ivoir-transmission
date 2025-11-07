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
        Schema::table('entreprises', function (Blueprint $table) {
            $table->string('otp')->nullable();
            $table->timestamp('otp_validated_at')->nullable();
            $table->timestamp('otp_expired_at')->nullable();
            $table->boolean('changed_first_password')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entreprises', function (Blueprint $table) {
            $table->dropColumn(['otp', 'otp_validated_at', 'otp_expired_at', 'changed_first_password']);
        });
    }
};
