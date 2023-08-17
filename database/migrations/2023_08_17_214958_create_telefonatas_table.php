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
        Schema::create('telefonatas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('eseguita_id');
            $table->unsignedBigInteger('client_id');
            $table->string('esito')->nullable();
            $table->string('note')->nullable();
            $table->boolean('effettuata')->nullable();
            $table->date('datarecall')->nullable();
            $table->integer('mese')->nullable();
            $table->integer('anno')->nullable();
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
        Schema::dropIfExists('telefonatas');
    }
};
