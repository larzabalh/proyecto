<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('cliente')->unique();
            $table->float('honorario')->nullable();
            $table->string('email')->nullable();
            $table->integer('facturador_id')->unsigned()->nullable();
            $table->foreign('facturador_id')->references('id')->on('facturadores');
            $table->integer('liquidador_id')->unsigned()->nullable();
            $table->foreign('liquidador_id')->references('id')->on('liquidadores');
            $table->integer('cobrador_id')->unsigned()->nullable();
            $table->foreign('cobrador_id')->references('id')->on('cobradores');
            $table->integer('disponibilidad_id')->unsigned()->nullable();
            $table->foreign('disponibilidad_id')->references('id')->on('disponibilidades');
            $table->string('contacto')->nullable();
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
            $table->timestamps();
        });

        /*DB::table('clientes')->insert([

            ['user_id' => 1, 'cliente' => 'Granny','honorario' => 600,'email' => 'kathryne.lakin@hotmail.com','facturador_id' => 3,'liquidador_id' => 1,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcela'],
            ['user_id' => 1, 'cliente' => 'Chatelet','honorario' => 600,'email' => 'raynor.freida@hotmail.com','facturador_id' => 3,'liquidador_id' => 1,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcela'],
            ['user_id' => 1, 'cliente' => 'Segovia Marcelo','honorario' => 300,'email' => 'abelardo.koch@hotmail.com','facturador_id' => 4,'liquidador_id' => 2,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcelo'],
            ['user_id' => 1, 'cliente' => 'Barea Mabel','honorario' => 1800,'email' => 'lilyan.littel@shields.net','facturador_id' => 4,'liquidador_id' => 2,'cobrador_id' => 2,'disponibilidad_id' => 7,'contacto' => 'Mabel'],
            ['user_id' => 1, 'cliente' => 'Lanieri Juan Manuel','honorario' => 3500,'email' => 'littel.eladio@gutmann.org','facturador_id' => 5,'liquidador_id' => 3,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Lily'],
            ['user_id' => 1, 'cliente' => 'Irineo SRL','honorario' => 3000,'email' => 'marisa.halvorson@zboncak.org','facturador_id' => 1,'liquidador_id' => 3,'cobrador_id' => 3,'disponibilidad_id' => 10,'contacto' => 'Pablo'],
            ['user_id' => 1, 'cliente' => 'Mosconi SRL','honorario' => 1000,'email' => 'cfisher@yahoo.com','facturador_id' => 1,'liquidador_id' => 3,'cobrador_id' => 3,'disponibilidad_id' => 1,'contacto' => 'Mariela'],
            ['user_id' => 1, 'cliente' => 'Britez Caceres Zunilda','honorario' => 700,'email' => 'fermin87@yahoo.com','facturador_id' => 2,'liquidador_id' => 4,'cobrador_id' => 1,'disponibilidad_id' => 6,'contacto' => 'Zunny'],
            ['user_id' => 1, 'cliente' => 'Arias Roberto','honorario' => 1500,'email' => 'mills.jordi@gmail.com','facturador_id' => 2,'liquidador_id' => 3,'cobrador_id' => 2,'disponibilidad_id' => 3,'contacto' => 'Roberto'],
            ['user_id' => 1, 'cliente' => 'Caballero Oscar','honorario' => 1300,'email' => 'kertzmann.kevon@denesik.com','facturador_id' => 5,'liquidador_id' => 6,'cobrador_id' => 3,'disponibilidad_id' => 4,'contacto' => 'Oscar'],
            ['user_id' => 1, 'cliente' => 'Espinoza Diego','honorario' => 2300,'email' => 'walker.randall@yahoo.com','facturador_id' => 3,'liquidador_id' => 5,'cobrador_id' => 1,'disponibilidad_id' => 5,'contacto' => 'Susana'],
                    ]);*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
