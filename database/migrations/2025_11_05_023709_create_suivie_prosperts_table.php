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
        Schema::connection('mysql3')->create('suivie_prosperts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('prospect_uuid')->nullable();
            $table->string('user_id')->nullable();
            $table->enum('type', ['call', 'email', 'meeting', 'other']);
            $table->text('notes')->nullable();
            $table->dateTime('followup_date')->nullable();
            $table->dateTime('next_followup_date')->nullable();
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivie_prosperts');
    }
};
