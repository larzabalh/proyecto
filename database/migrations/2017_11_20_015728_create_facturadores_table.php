<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturadores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('facturador')->nullable();
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('facturadores')->insert([
          ['user_id' => 1, 'facturador' => 'IN TIME SRL'],
          ['user_id' => 1, 'facturador' => 'TORTORELLI VANESA'],
          ['user_id' => 1, 'facturador' => 'LARZABAL HERNAN'],
          ['user_id' => 1, 'facturador' => 'PANZITTA GRACIELA'],
          ['user_id' => 1, 'facturador' => 'LARZABAL OMAR'],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturadores');
    }
}
