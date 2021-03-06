<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('fecha')->nullable();
            $table->integer('gasto_id')->unsigned();
            $table->foreign('gasto_id')->references('id')->on('gastos')->onDelete('cascade');
            $table->integer('forma_de_pagos_id')->unsigned();
            $table->foreign('forma_de_pagos_id')->references('id')->on('forma_de_pagos')->onDelete('cascade');
            $table->float('importe');
            $table->boolean('pagado')->nullable();//1 esta pago, vacio impago
            $table->string('comentario')->nullable();
            $table->boolean('masivo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reg_gastos');
    }
}
