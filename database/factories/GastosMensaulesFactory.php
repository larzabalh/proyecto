<?php

use Faker\Generator as Faker;
use App\GastosMensuales;
use App\Forma_de_Pagos;
use App\Disponibilidad;

$factory->define(GastosMensuales::class, function (Faker $faker) {
    return [
       'user_id'=> 1,
      'gasto_id'=> App\Gasto::all()->random()->id,
      'forma_de_pagos_id'=> App\Forma_de_Pagos::all()->random()->id,
      'importe'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 1000),
    ];
});
