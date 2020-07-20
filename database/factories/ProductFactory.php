<?php

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

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'category_id' => factory(\App\Models\Category::class)->create()->id,
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'status' => \App\Models\Product::STATUS_ACTIVE,
        'price' => $faker->randomFloat(2, 10, 2000),
    ];
});
