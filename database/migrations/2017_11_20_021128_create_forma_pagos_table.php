<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormaPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_pagos', function (Blueprint $table) {
            //Caja Oficina, VISA,Amex,Mastercard
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nombre');
            $table->integer('disponibilidad_id')->unsigned()->nullable();
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidades')->onDelete('cascade');
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
        Schema::dropIfExists('forma_pagos');
    }
}
