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
        Schema::create('filiale_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('filiale_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('filiale_id')->references('id')->on('filiales');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unique(['filiale_id', 'user_id']);
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
        Schema::dropIfExists('filiale_user');
    }
};
