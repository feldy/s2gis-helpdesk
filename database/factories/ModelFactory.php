<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
//$factory->define(App\User::class, function (Faker\Generator $faker) {
//    static $password;
//
//    return [
//        'name' => $faker->name,
//        'email' => $faker->unique()->safeEmail,
//        'password' => $password ?: $password = bcrypt('secret'),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(\App\Model\PICModel::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->uuid,
        'name' => $faker->name,
        'initial_name' => substr($faker->name, 1, 2),
        'user_id' => $faker->uuid,
        'type' => 'PROGRAMMER'
    ];
});

$factory->define(\App\Model\IssueHdrModel::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->uuid,
        'nomor_issue' => $faker->unique()->randomNumber(),
        'subject' => $faker->paragraph(1),
        'user_id' => $faker->uuid,
        'form_id' => $faker->uuid,
        'form_name' => $faker->paragraph(1),
        'pic_id' => function() {
            return factory(\App\Model\PICModel::class)->create()->id;
        },
        'type' => 'ISSUE',
        'status' => 'NEW'
    ];
});

$factory->define(\App\Model\IssueDtlModel::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->uuid,
        'sender_id' => $faker->uuid,
        'receiver_id' => $faker->uuid,
        'keterangan' => $faker->paragraph
    ];
});
