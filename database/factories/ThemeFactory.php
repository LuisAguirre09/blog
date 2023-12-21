<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Theme;
use Faker\Generator as Faker;

$factory->define(Theme::class, function (Faker $faker) {
    $nombre = $faker->unique()->word;
    return [
        'user_id' => 1, // hacer para que solo un usuario pueda crear un usuario
        'nombre' => ucfirst($nombre),
        'slug' => $nombre,
        'destacado' => $faker->boolean(false),
        'suscripcion' => $faker->boolean(false),
    ];
});
