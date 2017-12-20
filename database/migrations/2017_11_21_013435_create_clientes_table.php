<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('cliente')->unique();
            $table->float('honorario');
            $table->string('email')->unique();
            $table->integer('facturador_id')->unsigned();
            $table->foreign('facturador_id')->references('id')->on('facturadores');
            $table->integer('liquidador_id')->unsigned();
            $table->foreign('liquidador_id')->references('id')->on('liquidadores');
            $table->integer('cobrador_id')->unsigned();
            $table->foreign('cobrador_id')->references('id')->on('cobradores');
            $table->integer('forma_de_pagos_id')->unsigned();
            $table->foreign('forma_de_pagos_id')->references('id')->on('forma_de_pagos');
            $table->string('contacto')->nullable();
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
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
        Schema::dropIfExists('clientes');
    }
}
