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
        Schema::create('doc_files', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->index();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->string('user_id')->nullable();
            $table->string('folderParent_id')->nullable();
            $table->string('isPrivate')->default('false')->nullable();
            $table->string('etat')->default('actif')->nullable();
            $table->string('deleted_at')->nullable();
            $table->string('deleted_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_files');
    }
};
