<?php

use Illuminate\Database\Seeder;

class SaldosInicialesBancariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cta_cte_disponibilidades')->insert([
           ['user_id' => 1,'disponibilidad_id' => 1, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 2, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 3, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 4, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 5, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 6, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 7, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 8, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 9, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 10, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 11, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 12, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 13, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 14, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           ['user_id' => 1,'disponibilidad_id' => 15, 'id_concepto' => 20050, 'comentario' => 'Saldo Inicial'],
           
         ]);
    }
}
