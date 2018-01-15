<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCtaCteClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cta_cte_clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('fecha')->nullable();
            $table->integer('cliente_id')->unsigned();
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->float('debe')->default(0);
            $table->float('haber')->default(0);
            $table->integer('disponibilidad_id')->unsigned()->nullable();
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidades')->onDelete('cascade');
            $table->string('comentario')->nullable();
            $table->boolean('masivo')->nullable();
            $table->boolean('pagado')->nullable();//1 esta pago, vacio impago
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
        Schema::dropIfExists('cta_cte_clientes');
    }
}
