<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFkCtaCteClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cta_cte_clientes', function (Blueprint $table) {
                
            $table->integer('id_cta_cte_disponibilidad')->unsigned()->nullable()->after('disponibilidad_id');
            $table->foreign('id_cta_cte_disponibilidad')->references('id')->on('cta_cte_disponibilidades')->onDelete('cascade');

        });
            
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Borrar el nuevo campo creado
            Schema::table('cta_cte_clientes', function(Blueprint $table)
            {
                $table->dropForeign('cta_cte_clientes_id_cta_cte_disponibilidad_foreign');
                $table->dropColumn('id_cta_cte_disponibilidad');
            });
    }
}
