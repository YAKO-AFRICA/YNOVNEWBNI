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
        Schema::connection('mysql3')->table('assurance_infos', function (Blueprint $table) {
            $table->integer('duree')->nullable();
            $table->string('prospert_uuid')->nullable();
            $table->string('banque')->nullable();
            $table->string('rib')->nullable();
            $table->string('codeBanque')->nullable(); 
            $table->string('codeGuichet')->nullable();
            $table->string('numeroCompte')->nullable();
            $table->string('cleRib')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assurance_infos', function (Blueprint $table) {
            //
        });
    }
};
