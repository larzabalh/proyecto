<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtaCteDisponibilidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cta_cte_disponibilidades', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('fecha')->nullable();
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->float('debe')->nullable();
            $table->float('haber')->nullable();
            $table->integer('disponibilidad_id')->unsigned()->nullable();
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidades')->onDelete('cascade');
            $table->integer('id_CtaCteCliente')->unsigned()->nullable();
            $table->foreign('id_CtaCteCliente')->references('id')->on('cta_cte_clientes')->onDelete('cascade');
            $table->integer('id_concepto')->unsigned()->nullable();
            $table->string('comentario')->nullable();
            $table->boolean('masivo')->nullable();
            $table->boolean('condicion')->default(1);
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
        Schema::dropIfExists('cta_cte_disponibilidades');
    }
}
