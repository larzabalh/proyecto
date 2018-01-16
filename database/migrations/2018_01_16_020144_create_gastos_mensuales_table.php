<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosMensualesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_mensuales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('gasto_id')->unsigned();
            $table->foreign('gasto_id')->references('id')->on('gastos')->onDelete('cascade');
            $table->integer('forma_de_pagos_id')->unsigned();
            $table->foreign('forma_de_pagos_id')->references('id')->on('forma_de_pagos')->onDelete('cascade');
            $table->float('importe');
            $table->string('comentario')->nullable();
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
        Schema::dropIfExists('gastos_mensuales');
    }
}
