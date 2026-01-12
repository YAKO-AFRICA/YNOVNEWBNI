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
        Schema::create('notif_groups', function (Blueprint $table) {
            $table->id();
            $table->string('code_group')->nullable();
            $table->string('name')->nullable();
            $table->enum('branche', ['BANKASS', 'COM', 'COURTIER','IND','PARTICULIER', 'OTHER'])->default('OTHER')->nullable();
            $table->string('etat')->default('actif')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notif_groups');
    }
};
