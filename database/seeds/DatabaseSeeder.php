<?php

use Illuminate\Database\Seeder;
use App\Cliente;
use App\Reg_Gasto;
use App\Forma_de_Pagos;
use Illuminate\Foundation\Auth\User;

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

          //  DB::table('users')->insert([
          //    ['id' => '1', 'name' => 'hernan','email' => 'larzabalh@hotmail.com','rol' => 'admin','password' => '123123','created_at' => new DateTime, 'updated_at' => new DateTime],
           //
          //  ]);

         DB::table('periodos')->insert([
           ['id' => '1', 'periodo' => '2017-01','user_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '2', 'periodo' => '2017-02','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '3', 'periodo' => '2017-03','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '4', 'periodo' => '2017-04','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '5', 'periodo' => '2017-05','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '6', 'periodo' => '2017-06','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '7', 'periodo' => '2017-07','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '8', 'periodo' => '2017-08','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '9', 'periodo' => '2017-09','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '10', 'periodo' => '2017-10','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '11', 'periodo' => '2017-11','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['id' => '12', 'periodo' => '2017-12','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],

         ]);

         DB::table('tipos_de_gastos')->insert([
           ['tipo' => 'FIJO','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['tipo' => 'VARIABLE','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['tipo' => 'OFICINA','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['tipo' => 'GISELA','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['tipo' => 'LIA','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
           ['tipo' => 'PADRES','user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
         ]);

         DB::table('gastos')->insert([
          ['gasto' => 'Florencia','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Agustina','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Jose Luis','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Graciela','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Bety','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Alquiler Ramon Falcon','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Amvitium','tipo_de_gasto_id' => 3,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Lidia','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Las Nieves Pedro','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Las Nieves Ana','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Diario Clarin','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'OSDE','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'ATM XR 300','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'Monotributo','tipo_de_gasto_id' => 1,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'TELEFONO','tipo_de_gasto_id' => 2,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'LUZ','tipo_de_gasto_id' => 2,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'NUSKIN','tipo_de_gasto_id' => 4,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'VIAJE A EEUU','tipo_de_gasto_id' => 4,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'ACA','tipo_de_gasto_id' => 5,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'UBER','tipo_de_gasto_id' => 5,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'VIAJE A PERU','tipo_de_gasto_id' => 6,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['gasto' => 'TV','tipo_de_gasto_id' => 6,'user_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],


        ]);

        DB::table('medios')->insert([
          ['id' => '1','user_id' => 1, 'nombre' => 'CAJA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2','user_id' => 1, 'nombre' => 'SANTANDER','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3','user_id' => 1, 'nombre' => 'HSBC','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4','user_id' => 1, 'nombre' => 'PATAGONIA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5','user_id' => 1, 'nombre' => 'GALICIA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6','user_id' => 1, 'nombre' => 'CIUDAD','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '7','user_id' => 1, 'nombre' => 'FRANCES','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '8','user_id' => 1, 'nombre' => 'NACION','created_at' => new DateTime, 'updated_at' => new DateTime],
        ]);

          DB::table('disponibilidades')->insert([
          ['id' => '1','user_id' => 1, 'nombre' => 'CAJA OFICINA','medio_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2','user_id' => 1, 'nombre' => '362626/0','medio_id' => 2,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3','user_id' => 1, 'nombre' => 'Cuenta del HSBC','medio_id' => 3,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4','user_id' => 1, 'nombre' => 'Cuenta del PATAGONIA','medio_id' => 4,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5','user_id' => 1, 'nombre' => 'Cuenta del GALICIA','medio_id' => 5,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6','user_id' => 1, 'nombre' => 'Cuenta del CIUDAD','medio_id' => 6,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '7','user_id' => 1, 'nombre' => 'Cuenta del FRANCES','medio_id' => 7,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '8','user_id' => 1, 'nombre' => 'Cuenta del NACION','medio_id' => 8,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '9','user_id' => 1, 'nombre' => 'Cuenta Omar Larzabal','medio_id' => 4,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '10','user_id' => 1, 'nombre' => 'Cuenta In TIme SRL','medio_id' => 4,'created_at' => new DateTime, 'updated_at' => new DateTime],
        ]);

        DB::table('forma_de_pagos')->insert([
          ['user_id' => 1, 'nombre' => 'VISA','disponibilidad_id' => 2,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'AMERICAN EXPRESS','disponibilidad_id' => 2,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'SHOPPING','disponibilidad_id' => 2,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'VISA','disponibilidad_id' => 3,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'MASTERCARD','disponibilidad_id' => 3,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'VISA','disponibilidad_id' => 4,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'VISA','disponibilidad_id' => 5,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'CENCOSUD','disponibilidad_id' => 2,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'NATIVA','disponibilidad_id' => 8,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'EFECTIVO','disponibilidad_id' => 1,'created_at' => new DateTime, 'updated_at' => new DateTime],
          ['user_id' => 1, 'nombre' => 'DEBITO AUTOMATICO','disponibilidad_id' => 3,'created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        DB::table('liquidadores')->insert([
          ['id' => '1','user_id' => 1, 'liquidador' => 'JOSE LUIS','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2','user_id' => 1, 'liquidador' => 'FLORENCIA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3','user_id' => 1, 'liquidador' => 'ELIZABET','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4','user_id' => 1, 'liquidador' => 'GRACIELA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5','user_id' => 1, 'liquidador' => 'BETTY','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6','user_id' => 1, 'liquidador' => 'AGUSTINA','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        DB::table('cobradores')->insert([
          ['id' => '1','user_id' => 1, 'cobrador' => 'HERNAN','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2','user_id' => 1, 'cobrador' => 'GRACIELA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3','user_id' => 1, 'cobrador' => 'BETTY','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        DB::table('facturadores')->insert([
          ['id' => '1','user_id' => 1, 'facturador' => 'IN TIME SRL','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2','user_id' => 1, 'facturador' => 'TORTORELLI VANESA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3','user_id' => 1, 'facturador' => 'LARZABAL HERNAN','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4','user_id' => 1, 'facturador' => 'PANZITTA GRACIELA','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5','user_id' => 1, 'facturador' => 'LARZABAL OMAR','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);


        DB::table('clientes')->insert([
          ['id' => '1','user_id' => 1, 'cliente' => 'Granny','honorario' => 600,'email' => 'kathryne.lakin@hotmail.com','facturador_id' => 3,'liquidador_id' => 1,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcela','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '2','user_id' => 1, 'cliente' => 'Chatelet','honorario' => 600,'email' => 'raynor.freida@hotmail.com','facturador_id' => 3,'liquidador_id' => 1,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcela','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '3','user_id' => 1, 'cliente' => 'Segovia Marcelo','honorario' => 300,'email' => 'abelardo.koch@hotmail.com','facturador_id' => 4,'liquidador_id' => 2,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Marcelo','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '4','user_id' => 1, 'cliente' => 'Barea Mabel','honorario' => 1800,'email' => 'lilyan.littel@shields.net','facturador_id' => 4,'liquidador_id' => 2,'cobrador_id' => 2,'disponibilidad_id' => 7,'contacto' => 'Mabel','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '5','user_id' => 1, 'cliente' => 'Lanieri Juan Manuel','honorario' => 3500,'email' => 'littel.eladio@gutmann.org','facturador_id' => 5,'liquidador_id' => 3,'cobrador_id' => 1,'disponibilidad_id' => 1,'contacto' => 'Lily','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '6','user_id' => 1, 'cliente' => 'Irineo SRL','honorario' => 3000,'email' => 'marisa.halvorson@zboncak.org','facturador_id' => 1,'liquidador_id' => 3,'cobrador_id' => 3,'disponibilidad_id' => 10,'contacto' => 'Pablo','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '7','user_id' => 1, 'cliente' => 'Mosconi SRL','honorario' => 1000,'email' => 'cfisher@yahoo.com','facturador_id' => 1,'liquidador_id' => 3,'cobrador_id' => 3,'disponibilidad_id' => 1,'contacto' => 'Mariela','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '8','user_id' => 1, 'cliente' => 'Britez Caceres Zunilda','honorario' => 700,'email' => 'fermin87@yahoo.com','facturador_id' => 2,'liquidador_id' => 4,'cobrador_id' => 1,'disponibilidad_id' => 6,'contacto' => 'Zunny','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '9','user_id' => 1, 'cliente' => 'Arias Roberto','honorario' => 1500,'email' => 'mills.jordi@gmail.com','facturador_id' => 2,'liquidador_id' => 3,'cobrador_id' => 2,'disponibilidad_id' => 3,'contacto' => 'Roberto','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '10','user_id' => 1, 'cliente' => 'Caballero Oscar','honorario' => 1300,'email' => 'kertzmann.kevon@denesik.com','facturador_id' => 5,'liquidador_id' => 6,'cobrador_id' => 3,'disponibilidad_id' => 4,'contacto' => 'Oscar','created_at' => new DateTime, 'updated_at' => new DateTime],
          ['id' => '11','user_id' => 1, 'cliente' => 'Espinoza Diego','honorario' => 2300,'email' => 'walker.randall@yahoo.com','facturador_id' => 3,'liquidador_id' => 5,'cobrador_id' => 1,'disponibilidad_id' => 5,'contacto' => 'Susana','created_at' => new DateTime, 'updated_at' => new DateTime],

        ]);

        $users = factory(Illuminate\Foundation\Auth\User::class)->times(1)->create();
        $reg_gasto = factory(Reg_Gasto::class)->times(120)->create();
        

      }
}
