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
        Schema::connection('mysql3')->create('adherent_prosperts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique()->index();
            $table->string('code')->unique()->nullable();
            
            // Informations personnelles
            $table->enum('civilite', ['M', 'Mme', 'Dr', 'Pr'])->nullable();
            $table->string('nom');
            $table->string('prenom');
            $table->enum('genre', ['M', 'F'])->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('lieu_naissance')->nullable();
            $table->string('lieu_residence')->nullable();
            $table->string('situation_matrimoniale')->nullable();
            
            // Pièce d'identité
            $table->string('type_piece_identite')->nullable();
            $table->string('numero_piece_identite')->nullable();
            
            // Coordonnées
            $table->string('email')->unique()->nullable();
            
            // Adresse
            $table->string('adresse')->nullable();
            $table->string('pays')->nullable();
            
            // Profession
            $table->string('profession')->nullable();
            $table->string('employeur')->nullable();
            $table->string('secteur_activite')->nullable();
            
            // personne de ressource
            $table->string('personneRessource')->nullable();
            $table->string('contactRessource')->nullable();
            $table->string('personneRessource2')->nullable();
            $table->string('contactRessource2')->nullable();
            
            // Autres informations
            $table->text('notes')->nullable();
            
            // Source du prospect
            $table->string('reference_par')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adherent_prosperts');
    }
};
