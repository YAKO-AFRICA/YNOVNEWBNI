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
        Schema::connection('mysql3')->create('assurance_infos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('code')->nullable();
            $table->string('dejaClient')->nullable();
            $table->string('assurerAuTerme')->nullable();
            $table->string('produit_uuid')->nullable();
            $table->string('datteEffet')->nullable();
            $table->string('modePaiement')->nullable();
            $table->string('periodicite')->nullable();
            $table->string('signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assurance_infos');
    }
};
