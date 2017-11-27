<?php

use Faker\Generator as Faker;
use App\Gasto;
/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Gasto::class, function (Faker $faker) {
    return [
          'gasto'=> $faker->word,
          'tipo_de_gasto_id'=> App\Tipo_de_gasto::all()->random()->id,

    ];
});
