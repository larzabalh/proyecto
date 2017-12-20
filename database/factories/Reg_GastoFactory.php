<?php

use Faker\Generator as Faker;
use App\Reg_Gasto;
use App\Forma_de_Pagos;
use App\Disponibilidad;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Reg_Gasto::class, function (Faker $faker) {


    return [
    	'user_id'=> 1,
      'fecha'=> $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = date_default_timezone_get()),
      'gasto_id'=> App\Gasto::all()->random()->id,
      'forma_de_pagos_id'=> App\Forma_de_Pagos::all()->random()->id,
      'importe'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100000),

    ];
});
