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
        Schema::create('file_managers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('path')->nullable();
            $table->string('mime_type')->nullable(); // Type MIME du fichier
            $table->unsignedBigInteger('size'); // Taille du fichier en octets
            $table->string('uuid')->unique(); // UUID devrait être unique
            $table->string('extension')->nullable(); // Extension du fichier
            
            // Relation avec le dossier parent
            $table->string('folder_id')->nullable();
            $table->text('description')->nullable();
            $table->string('etat')->default('actif');
            
            // Utilisateur qui a créé le fichier
            $table->string('user_id')->nullable();

            $table->date('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_managers');
    }
};
