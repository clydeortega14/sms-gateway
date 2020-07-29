<?php

use Faker\Generator as Faker;

$factory->define(App\SentMessage::class, function (Faker $faker) {
    return [
        'invoice_number' => '20190101-1-1',
        'credentials_id' => '1',
        'branch_id' => '1',
        'number' => $faker->phoneNumber,
        'message' => $faker->sentence
    ];
});
