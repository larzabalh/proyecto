<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGastosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('gasto');
            $table->string('condicion')->default(1);
            $table->integer('tipo_de_gasto_id')->unsigned();
            $table->foreign('tipo_de_gasto_id')->references('id')->on('tipos_de_gastos')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });

        DB::update('ALTER TABLE gastos AUTO_INCREMENT = 20000;');
        /*
        1=> FIJO
        2=> VARIABLE
        3=> OFICINA
        4=> GISELA
        5=> LIA
        6=> PADRES
        7=> OBRA CASA
        8=> IN TIME SRL
        9=> GRACIELA
        1=>OMAR*/


        DB::table('gastos')->insert([
          ['gasto' => 'Sueldo Florencia','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Sueldo Elizabet','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Sueldo Agustina','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Sueldo Jose Luis','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Sueldo Graciela','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Sueldo Bety','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Sueldo Karina','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Alquiler Ramon Falcon','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Amvitium','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Agenda Unica','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Monotributo Graciela','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Autonomos Hernan','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Autonomos Omar','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'IIBB IN TIME SRL','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'IVA IN TIME SRL','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'VARIOS','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'TOWEBS','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'GOOGLE ADWORDS','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'VOLANTES','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Telecentro Oficina','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Callejas Martin','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Larzabal Gisela','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Movistar Oficina','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Telefonica Oficina','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Prestamo DUSTER','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Comida','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Nafta','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Cablevision','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Lidia','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Netflix','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'AYSA','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Entrenados Personales','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Sistema','tipo_de_gasto_id' => 3,'user_id' => 1],
          ['gasto' => 'Las Nieves Pedro','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Las Nieves Ana','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Matricula CPCEPBA','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Diario Clarin','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Diario La Nacion','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'OSDE','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'ATM XR 300','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Monotributo Hernan','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Monotributo Vane','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Spotify','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Edesur','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Personal Celulares','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Telefonica Casa','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'LUZ','tipo_de_gasto_id' => 2,'user_id' => 1],
          ['gasto' => 'NUSKIN','tipo_de_gasto_id' => 4,'user_id' => 1],
          ['gasto' => 'VIAJE A EEUU','tipo_de_gasto_id' => 4,'user_id' => 1],
          ['gasto' => 'ACA','tipo_de_gasto_id' => 5,'user_id' => 1],
          ['gasto' => 'SALDO INICIAL','tipo_de_gasto_id' => 1,'user_id' => 1],
          ['gasto' => 'Cablevision Gisela','tipo_de_gasto_id' => 4,'user_id' => 1],
          ['gasto' => 'Zurich Gisela','tipo_de_gasto_id' => 4,'user_id' => 1],

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
}
