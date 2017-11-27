<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisponibilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disponibilidades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('disponibilidad')->unique();
            $table->float('debe')->nullable();;
            $table->float('haber')->nullable();;
            // $table->integer('forma_pagos_id')->unsigned()->nullable();
            // $table->foreign('forma_pagos_id')->references('id')->on('forma_pagos');
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
        Schema::dropIfExists('disponibilidades');
    }
}
