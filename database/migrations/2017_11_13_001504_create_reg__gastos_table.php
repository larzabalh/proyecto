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
            $table->timestamp('fecha');
            $table->integer('gasto_id')->unsigned();
            $table->foreign('gasto_id')->references('id')->on('gastos');
            // $table->integer('tipo_de_gasto_id')->unsigned();
            // $table->foreign('tipo_de_gasto_id')->references('id')->on('tipos_de_gastos');
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
        Schema::dropIfExists('reg_gastos');
    }
}
