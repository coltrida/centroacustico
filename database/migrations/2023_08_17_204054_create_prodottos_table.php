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
        Schema::create('prodottos', function (Blueprint $table) {
            $table->id();
            $table->string('matricola')->nullable();
            $table->unsignedBigInteger('stato_id')->nullable();
            $table->unsignedBigInteger('filiale_id')->nullable();
            $table->unsignedBigInteger('listino_id')->nullable();
            $table->unsignedBigInteger('prova_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->date('datacarico')->nullable();
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
        Schema::dropIfExists('prodottos');
    }
};
