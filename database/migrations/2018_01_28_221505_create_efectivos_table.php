<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEfectivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('efectivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->timestamp('fecha')->nullable();
            $table->string('nombre');
            $table->float('importe')->unsigned()->default(0);
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
            $table->timestamps();
        });

          DB::table('efectivos')->insert([
           ['nombre' => 'CAJA CASA','user_id' => 1],
           ['nombre' => 'CAJA OFICINA','user_id' => 1],
           ['nombre' => 'JAVI ME DEBE','user_id' => 1],
           ['nombre' => 'GISELA ME DEBE','user_id' => 1],
           ['nombre' => 'LIA','user_id' => 1],
           ['nombre' => 'DOLARES CASA','user_id' => 1],
         ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('efectivos');
    }
}
