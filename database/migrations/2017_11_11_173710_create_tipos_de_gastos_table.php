<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTiposDeGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
        Schema::create('tipos_de_gastos', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->string('tipo');
          $table->string('condicion')->default(1);
          $table->timestamps();
        });

        \DB::table('tipos_de_gastos')->insert([
          ['tipo' => 'FIJO','user_id' => 1],
          ['tipo' => 'VARIABLE','user_id' => 1],
          ['tipo' => 'OFICINA','user_id' => 1],
          ['tipo' => 'GISELA','user_id' => 1],
          ['tipo' => 'LIA','user_id' => 1],
          ['tipo' => 'PADRES','user_id' => 1],
          ['tipo' => 'OBRA CASA','user_id' => 1],
          ['tipo' => 'IN TIME SRL','user_id' => 1],
          ['tipo' => 'GRACIELA','user_id' => 1],
          ['tipo' => 'OMAR','user_id' => 1],

       ]);

    }

   

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipos_de_gastos');
    }
}
