<?php

use Faker\Generator as Faker;

use Illuminate\Foundation\Auth\User;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Illuminate\Foundation\Auth\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => 'hernan',
        'email' => 'larzabalh@hotmail.com',
        'password' => $password ?: $password = bcrypt('123123'),
        'rol' => 'admin',
        'remember_token' => str_random(10),
    ];
});
