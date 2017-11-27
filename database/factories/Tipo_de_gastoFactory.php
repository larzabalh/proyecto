<?php

use Faker\Generator as Faker;
use App\Tipo_de_gasto;
/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Tipo_de_gasto::class, function (Faker $faker) {
    return [
      'tipo'=> 'FIJO',
      'tipo'=> 'VARIABLE',
    ];
});
