<?php

use Faker\Generator as Faker;
use App\Cliente;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Cliente::class, function (Faker $faker) {
    return [
      'cliente'=> $faker->unique()->word,
      'honorario'=> $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = 6000),
      'email'=> $faker->unique()->email,
      'facturador_id'=> App\Facturador::all()->random()->id,
      'liquidador_id'=> App\Liquidador::all()->random()->id,
      'cobrador_id'=>   App\Cobrador::all()->random()->id,
      'disponibilidad_id'=> App\Disponibilidad::all()->random()->id,
      'contacto'=> $faker->name,

    ];
});
