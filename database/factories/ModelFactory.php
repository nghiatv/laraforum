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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    $email = $faker->unique()->safeEmail();
    return [
        'name' => $faker->name,
        'email' => $email,
        'password' => $password ?: $password = bcrypt('secret'),
        'confirmation_code' => md5($email),
        'confirmed' => 1,
        'avatar_link' => $faker->imageUrl(),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    $title = $faker->unique()->firstNameMale;

    return [
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->paragraph,
        'active' => 1,
    ];
});



