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
        Schema::create('fatturas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prova_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('data_fattura')->nullable();
            $table->integer('mese_fattura')->nullable();
            $table->integer('anno_fattura')->nullable();
            $table->integer('acconto')->nullable();
            $table->integer('nr_rate')->nullable();
            $table->integer('tot_fattura')->nullable();
            $table->integer('al_saldo')->nullable();
            $table->boolean('saldata')->nullable()->default(0);
            $table->boolean('pagatoAudio')->nullable()->default(0);
            $table->integer('progressivo')->nullable();
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
        Schema::dropIfExists('fatturas');
    }
};
