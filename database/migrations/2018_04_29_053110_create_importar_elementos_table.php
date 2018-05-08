<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportarElementosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //
        Schema::create('importar_elementos', function (Blueprint $table) {
          $table->increments('id');
          $table->string('nombre');
          $table->string('condicion')->default(1);
          $table->timestamps();
          $table->softDeletes();
        });

        \DB::table('importar_elementos')->insert([
          ['nombre' => 'CLIENTES'],
          ['nombre' => 'BANCOS'],
          ['nombre' => 'LIQUIDADORES'],
          ['nombre' => 'GASTOS'],
          ['nombre' => 'TIPOS'],
          ['nombre' => 'INGRESOS'],
          ['nombre' => 'EGRESOS'],

       ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('importar_elementos');
    }
}
