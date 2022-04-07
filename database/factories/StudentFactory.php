<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'nama' => $faker->name,
        'alamat' => $faker->secondaryAddress, 
        'JK' => $faker->randomElement(['Pria', 'Wanita']),
        'Kelas' => $faker->randomElement(['RPL', 'TKJ', 'MM']),
    ];
});
