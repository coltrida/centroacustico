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
        Schema::create('appuntamentos', function (Blueprint $table) {
            $table->id();
            $table->date('giorno');
            $table->string('giornoFormattato');
            $table->integer('orario');
            $table->string('nota')->nullable();
            $table->string('tipo');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('filiale_id')->nullable();
            $table->unsignedBigInteger('recapito_id')->nullable();
            $table->boolean('intervenuto')->nullable();
            $table->timestamps();
            $table->integer('mese')->nullable();
            $table->integer('anno')->nullable();
            $table->integer('settimana')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appuntamentos');
    }
};
