<?php

use Faker\Generator as Faker;
use App\Models\Status;

$factory->define(Status::class, function (Faker $faker) {
    $data_time = $faker->date(). ' '. $faker->time();

    return [
        'content' => $faker->paragraph(),
        'created_at' => $data_time,
        'updated_at' => $data_time
    ];
});
