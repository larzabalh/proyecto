<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medios', function (Blueprint $table) {
            //SANTANDER, GALICIA, PATAGONIA, CAJA, FRANCES
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nombre')->unique();
            $table->string('condicion')->default(1);
            $table->timestamps();
        });
        DB::table('medios')->insert([
          ['user_id' => 1, 'nombre' => 'CAJA'],
          ['user_id' => 1, 'nombre' => 'SANTANDER'],
          ['user_id' => 1, 'nombre' => 'HSBC'],
          ['user_id' => 1, 'nombre' => 'PATAGONIA'],
          ['user_id' => 1, 'nombre' => 'GALICIA'],
          ['user_id' => 1, 'nombre' => 'CIUDAD'],
          ['user_id' => 1, 'nombre' => 'FRANCES'],
          ['user_id' => 1, 'nombre' => 'NACION'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medios');
    }
}
