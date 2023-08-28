<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('nomeAzienda')->nullable();
            $table->string('indirizzoAzienda')->nullable();
            $table->string('cittaAzienda')->nullable();
            $table->string('provinciaAzienda')->nullable();
            $table->string('capAzienda')->nullable();
            $table->string('pivaAzienda')->nullable();
            $table->string('emailAzienda')->nullable();
            $table->string('pecAzienda')->nullable();
            $table->string('telefonoAzienda')->nullable();
            $table->boolean('eseguitaConfigurazione')->nullable();
            $table->boolean('magazzinoCentralizzato')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
};
