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
        Schema::create('provas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('filiale_id')->nullable();
            $table->unsignedBigInteger('canale_id')->nullable();
            $table->string('tot')->nullable();
            $table->unsignedBigInteger('stato_id')->nullable();
            $table->date('inizio_prova')->nullable();
            $table->date('fine_prova')->nullable();
            $table->integer('mese_fine')->nullable();
            $table->integer('anno_fine')->nullable();
            $table->integer('mese_inizio')->nullable();
            $table->integer('anno_inizio')->nullable();
            $table->integer('giorni_prova')->nullable();
            $table->string('nota')->nullable();
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
        Schema::dropIfExists('provas');
    }
};
