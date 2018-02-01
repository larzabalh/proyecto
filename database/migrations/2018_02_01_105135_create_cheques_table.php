<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('fecha')->nullable();
            $table->timestamp('fecha_cobrar')->nullable();
            $table->float('importe')->unsigned();
            $table->string('banco')->nullable();
            $table->string('numero')->nullable();
            $table->string('tipo')->nullable();
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->string('titular')->nullable();
            $table->string('destino')->nullable();
            $table->boolean('estado')->nullable();//1 esta cobrado, vacio Pendiente de Cobro
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
        Schema::dropIfExists('cheques');
    }
}
