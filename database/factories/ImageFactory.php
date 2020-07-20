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

$factory->define(App\Models\Image::class, function (Faker $faker, $arguments = []) {
    return [
        'product_id' => $arguments['product_id'] ?? factory(\App\Models\Product::class)->create()->id,
        'path' => 'images/product_example.jpg',
        'description' => $faker->sentence,
        'is_cover' => true,
    ];
});
