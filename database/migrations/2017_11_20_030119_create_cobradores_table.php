<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCobradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cobradores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('cobrador')->nullable();
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
            $table->timestamps();
            $table->softDeletes();
            
        });

        DB::table('cobradores')->insert([
          ['user_id' => 1, 'cobrador' => 'HERNAN'],
          ['user_id' => 1, 'cobrador' => 'GRACIELA'],
          ['user_id' => 1, 'cobrador' => 'BETTY'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cobradores');
    }
}
