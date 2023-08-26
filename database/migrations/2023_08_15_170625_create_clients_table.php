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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_id');
            $table->string('nome');
            $table->string('cognome');
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('indirizzo')->nullable();
            $table->string('citta')->nullable();
            $table->string('provincia')->nullable();
            $table->string('cap')->nullable();
            $table->string('email')->nullable();
            $table->dateTime('dataNascita')->nullable();
            $table->unsignedBigInteger('filiale_id');
            $table->unsignedBigInteger('canale_id');
            $table->unsignedBigInteger('recapito_id')->nullable();
            $table->unsignedBigInteger('medico_id')->nullable();
            $table->string('codfisc')->unique()->nullable();
            $table->string('fullName')->nullable();
            $table->string('fullNameReverse')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
