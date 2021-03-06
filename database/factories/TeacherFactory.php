<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Teacher;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'alamat' => $faker->secondaryAddress, 
        'JK' => $faker->randomElement(['Pria', 'Wanita']),
    ];
});
