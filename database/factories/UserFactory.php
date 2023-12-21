<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,

        // Mio
        'alias' => $faker->unique()->word,
        'web' =>$faker->safeEmailDomain,
        'bloqueado' => $faker->boolean(false),
        'es_admin' => $faker->boolean(false),
        // 'email_verified_at' => now(),
        'password' => bcrypt('12345'),
        // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeBetween('-3 years', 'now', 'America/Monterrey'),
    ];
});
