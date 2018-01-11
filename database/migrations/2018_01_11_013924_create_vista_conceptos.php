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
                        select id, user_id,cliente as concepto from clientes
                        union
                        select id, user_id,nombre from forma_de_pagos
                        union
                        select id, user_id,gasto from gastos' 
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
