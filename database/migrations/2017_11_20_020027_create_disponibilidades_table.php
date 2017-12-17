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
            //CAJA, 362929/0, chequeras
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nombre')->unique();
            $table->float('debe')->nullable();;
            $table->float('haber')->nullable();;
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
            $table->integer('medio_id')->unsigned()->nullable();
            $table->foreign('medio_id')->references('id')->on('medios')->onDelete('cascade');
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
