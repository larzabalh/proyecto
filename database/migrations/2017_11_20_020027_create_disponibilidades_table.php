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
            $table->string('comentario')->nullable();
            $table->string('condicion')->default(1);
            $table->integer('medio_id')->unsigned()->nullable();
            $table->foreign('medio_id')->references('id')->on('medios')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

            DB::table('disponibilidades')->insert([
            ['user_id' => 1, 'nombre' => 'CAJA OFICINA','medio_id' => 1],
            ['user_id' => 1, 'nombre' => 'CAJA CASA','medio_id' => 1],
            ['user_id' => 1, 'nombre' => 'CAJA DOLARES CASA','medio_id' => 1],
            ['user_id' => 1, 'nombre' => 'Santander: 362626/0 - HERNAN','medio_id' => 2],
            ['user_id' => 1, 'nombre' => 'HSBC: 0826204882 - HERNAN','medio_id' => 3],
            ['user_id' => 1, 'nombre' => 'Patagonia: 236-710404845-000 - HERNAN','medio_id' => 4],
            ['user_id' => 1, 'nombre' => 'Galicia: 4019337-2-027-7 VANE','medio_id' => 5],
            ['user_id' => 1, 'nombre' => 'Ciudad: 8341/0 - HERNAN','medio_id' => 6],
            ['user_id' => 1, 'nombre' => 'CA: 318-730517/5 - VANE','medio_id' => 7],
            ['user_id' => 1, 'nombre' => 'Cuenta del NACION','medio_id' => 8],
            ['user_id' => 1, 'nombre' => 'Cuenta Omar Larzabal','medio_id' => 4],
            ['user_id' => 1, 'nombre' => 'Cuenta In TIme SRL','medio_id' => 4],
            ['user_id' => 1, 'nombre' => 'Cuenta Ciudad In TIme SRL','medio_id' => 6],
            ['user_id' => 1, 'nombre' => 'Cuenta Problema Resuelto SAS','medio_id' => 4],
            ['user_id' => 1, 'nombre' => 'Cuenta Graciela','medio_id' => 4],
            ]);
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
