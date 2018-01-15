<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVistaConceptos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement( 'create view view_conceptos as 
                        select clientes.id, clientes.user_id,clientes.cliente as concepto from clientes
                        union
                        select forma_de_pagos.id, forma_de_pagos.user_id,concat(medios.nombre, "-" ,forma_de_pagos.nombre) as concepto from forma_de_pagos
                            join disponibilidades on forma_de_pagos.disponibilidad_id = disponibilidades.id
                            join medios on disponibilidades.medio_id = medios.id
                        union
                        select gastos.id, gastos.user_id,gastos.gasto as concepto from gastos' 
                    );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS view_conceptos');
    }
}
