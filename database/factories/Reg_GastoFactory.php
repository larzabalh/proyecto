<?php

use Faker\Generator as Faker;
use App\Reg_Gasto;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Reg_Gasto::class, function (Faker $faker) {


    return [
      'fecha'=> $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = date_default_timezone_get()),
      'gasto_id'=> App\Gasto::all()->random()->id,
      // 'tipo_de_gasto_id'=> App\Tipo_de_gasto::all()->random()->id,

      // 'tipo_de_gasto_id'=>  App\Gasto::all()->random()->tipo_de_gasto_id,
      'importe'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 100000),

    ];
});
