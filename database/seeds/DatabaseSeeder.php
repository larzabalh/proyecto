<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Reg_Gasto;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $tipos_de_gastos = factory(Tipo_de_gasto::class)->times(5)->create();
           // $gastos = factory(Gasto::class)->times(20)->create();

           DB::table('users')->insert([
             ['id' => '1', 'name' => 'hernan','email' => 'larzabalh@hotmail.com','rol' => 'admin','password' => '123123','created_at' => new DateTime, 'updated_at' => new DateTime],

           ]);

         DB::table('periodos')->insert([
           ['id' => '1', 'periodo' => '2017-01','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '2', 'periodo' => '2017-02','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '3', 'periodo' => '2017-03','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '4', 'periodo' => '2017-04','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '5', 'periodo' => '2017-05','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '6', 'periodo' => '2017-06','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '7', 'periodo' => '2017-07','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '8', 'periodo' => '2017-08','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '9', 'periodo' => '2017-09','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '10', 'periodo' => '2017-10','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '11', 'periodo' => '2017-11','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '12', 'periodo' => '2017-12','created_at' => new DateTime, 'updated_at' => new DateTime],

         ]);

         DB::table('tipos_de_gastos')->insert([
           ['id' => '1', 'tipo' => 'FIJO','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '2', 'tipo' => 'VARIABLE','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '3', 'tipo' => 'OFICINA','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '4', 'tipo' => 'GISELA','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '5', 'tipo' => 'LIA','created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '6', 'tipo' => 'PADRES','created_at' => new DateTime, 'updated_at' => new DateTime],
         ]);

         DB::table('gastos')->insert([
          ['id' => '1', 'gasto' => 'Florencia','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2', 'gasto' => 'Agustina','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3', 'gasto' => 'Jose Luis','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4', 'gasto' => 'Graciela','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5', 'gasto' => 'Bety','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6', 'gasto' => 'Alquiler Ramon Falcon','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '7', 'gasto' => 'Amvitium','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '8', 'gasto' => 'Lidia','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '9', 'gasto' => 'Las Nieves Pedro','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '10', 'gasto' => 'Las Nieves Ana','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '11', 'gasto' => 'Diario Clarin','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '12', 'gasto' => 'OSDE','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '13', 'gasto' => 'ATM XR 300','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '14', 'gasto' => 'Monotributo','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '15', 'gasto' => 'TELEFONO','tipo_de_gasto_id' => 2,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '16', 'gasto' => 'LUZ','tipo_de_gasto_id' => 2,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '17', 'gasto' => 'NUSKIN','tipo_de_gasto_id' => 4,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '18', 'gasto' => 'VIAJE A EEUU','tipo_de_gasto_id' => 4,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '19', 'gasto' => 'ACA','tipo_de_gasto_id' => 5,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '20', 'gasto' => 'UBER','tipo_de_gasto_id' => 5,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '21', 'gasto' => 'VIAJE A PERU','tipo_de_gasto_id' => 6,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '22', 'gasto' => 'TV','tipo_de_gasto_id' => 6,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],


        ]);

        DB::table('disponibilidades')->insert([
          ['id' => '1', 'disponibilidad' => 'CAJA OFICINA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2', 'disponibilidad' => 'CAJA CASA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3', 'disponibilidad' => 'SANTANDER','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4', 'disponibilidad' => 'HSBC','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5', 'disponibilidad' => 'PATAGONIA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6', 'disponibilidad' => 'GALICIA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '7', 'disponibilidad' => 'CIUDAD','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '8', 'disponibilidad' => 'FRANCES','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '9', 'disponibilidad' => 'PATAGONIA OMAR','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '10', 'disponibilidad' => 'PATAGONIA IN TIME SRL','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '11', 'disponibilidad' => 'NACION','created_at' => new DateTime, 'updated_at' => new DateTime],
        ]);

        DB::table('liquidadores')->insert([
          ['id' => '1', 'liquidador' => 'JOSE LUIS','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2', 'liquidador' => 'FLORENCIA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3', 'liquidador' => 'ELIZABET','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4', 'liquidador' => 'GRACIELA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5', 'liquidador' => 'BETTY','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6', 'liquidador' => 'AGUSTINA','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        DB::table('cobradores')->insert([
          ['id' => '1', 'cobrador' => 'HERNAN','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2', 'cobrador' => 'GRACIELA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3', 'cobrador' => 'BETTY','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        DB::table('facturadores')->insert([
          ['id' => '1', 'facturador' => 'IN TIME SRL','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2', 'facturador' => 'TORTORELLI VANESA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3', 'facturador' => 'LARZABAL HERNAN','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4', 'facturador' => 'PANZITTA GRACIELA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5', 'facturador' => 'LARZABAL OMAR','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        DB::table('forma_pagos')->insert([
          ['id' => '1', 'forma_pago' => 'VISA','disponibilidad_id' => '3','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2', 'forma_pago' => 'AMERICAN EXPRESS','disponibilidad_id' => '3','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3', 'forma_pago' => 'SHOPPING','disponibilidad_id' => '3','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4', 'forma_pago' => 'VISA','disponibilidad_id' => '4','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5', 'forma_pago' => 'MASTERCARD','disponibilidad_id' => '4','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6', 'forma_pago' => 'VISA','disponibilidad_id' => '5','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '7', 'forma_pago' => 'VISA','disponibilidad_id' => '7','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '8', 'forma_pago' => 'CENCOSUD','disponibilidad_id' => '3','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '9', 'forma_pago' => 'NATIVA','disponibilidad_id' => '11','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '10', 'forma_pago' => 'EFECTIVO','disponibilidad_id' => '1','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '11', 'forma_pago' => 'DEBITO AUTOMATICO','disponibilidad_id' => '4','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        DB::table('clientes')->insert([
          ['id' => '1', 'cliente' => 'Granny','honorario' => 600,'email' => 'kathryne.lakin@hotmail.com','facturador_id' => 3,'liquidador_id' => 1,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcela','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2', 'cliente' => 'Chatelet','honorario' => 600,'email' => 'raynor.freida@hotmail.com','facturador_id' => 3,'liquidador_id' => 1,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcela','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3', 'cliente' => 'Segovia Marcelo','honorario' => 300,'email' => 'abelardo.koch@hotmail.com','facturador_id' => 4,'liquidador_id' => 2,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcelo','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4', 'cliente' => 'Barea Mabel','honorario' => 1800,'email' => 'lilyan.littel@shields.net','facturador_id' => 4,'liquidador_id' => 2,'cobrador_id' => 2,'disponibilidad_id' => 7,'contacto' => 'Mabel','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5', 'cliente' => 'Lanieri Juan Manuel','honorario' => 3500,'email' => 'littel.eladio@gutmann.org','facturador_id' => 5,'liquidador_id' => 3,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Lily','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6', 'cliente' => 'Irineo SRL','honorario' => 3000,'email' => 'marisa.halvorson@zboncak.org','facturador_id' => 1,'liquidador_id' => 3,'cobrador_id' => 3,'disponibilidad_id' => 10,'contacto' => 'Pablo','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '7', 'cliente' => 'Mosconi SRL','honorario' => 1000,'email' => 'cfisher@yahoo.com','facturador_id' => 1,'liquidador_id' => 3,'cobrador_id' => 3,'disponibilidad_id' => 1,'contacto' => 'Mariela','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '8', 'cliente' => 'Britez Caceres Zunilda','honorario' => 700,'email' => 'fermin87@yahoo.com','facturador_id' => 2,'liquidador_id' => 4,'cobrador_id' => 1,'disponibilidad_id' => 6,'contacto' => 'Zunny','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '9', 'cliente' => 'Arias Roberto','honorario' => 1500,'email' => 'mills.jordi@gmail.com','facturador_id' => 2,'liquidador_id' => 3,'cobrador_id' => 2,'disponibilidad_id' => 3,'contacto' => 'Roberto','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '10', 'cliente' => 'Caballero Oscar','honorario' => 1300,'email' => 'kertzmann.kevon@denesik.com','facturador_id' => 5,'liquidador_id' => 6,'cobrador_id' => 3,'disponibilidad_id' => 4,'contacto' => 'Oscar','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '11', 'cliente' => 'Espinoza Diego','honorario' => 2300,'email' => 'walker.randall@yahoo.com','facturador_id' => 3,'liquidador_id' => 5,'cobrador_id' => 1,'disponibilidad_id' => 5,'contacto' => 'Susana','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        $reg_gasto = factory(Reg_Gasto::class)->times(3000)->create();
          // $clientes = factory(Cliente::class)->times(30)->create();

      }
}
