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
        Schema::connection('mysql3')->create('partner_prosperts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();
            $table->string('code')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('genre')->nullable();
            $table->string('civilite')->nullable();
            $table->string('naturepiece')->nullable();
            $table->string('numeropiece')->nullable();
            $table->string('email')->nullable();
            $table->string('situationMatrimoniale')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->string('lieuNaissance')->nullable();
            $table->string('lieuResidence')->nullable();
            $table->string('adresseComplete')->nullable();
            $table->string('profession')->nullable();
            $table->string('employeur')->nullable();
            $table->string('mobile')->nullable();

            $table->string('prospert_uuid')->nullable();
            $table->string('filliation_code')->nullable();
            $table->string('code_partner')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_prosperts');
    }
};
