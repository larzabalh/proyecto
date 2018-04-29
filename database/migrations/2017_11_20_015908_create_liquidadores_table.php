<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLiquidadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('liquidadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('liquidador')->nullable();
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
            $table->timestamps();
        });

        DB::table('liquidadores')->insert([
          ['user_id' => 1, 'liquidador' => 'JOSE LUIS'],
          ['user_id' => 1, 'liquidador' => 'FLORENCIA'],
          ['user_id' => 1, 'liquidador' => 'ELIZABET'],
          ['user_id' => 1, 'liquidador' => 'GRACIELA'],
          ['user_id' => 1, 'liquidador' => 'BETTY'],
          ['user_id' => 1, 'liquidador' => 'AGUSTINA'],

        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('liquidadores');
    }
}
