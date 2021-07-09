<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\JobCase;
use Faker\Generator as Faker;
use Carbon\Carbon;
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



$factory->define(JobCase::class, function (Faker $faker) {
    $user =  App\User::where('roleid', '1')->pluck('id')->all();
    $tech =  App\User::where('roleid', '2')->pluck('id')->all();
    
    return [
        'caseTypeId' => $faker->randomElement(['18', '19', '20', '21', '22']),
        'userId' => $faker->randomElement($user),
        'techId' => $faker->randomElement($tech),
        'jobStatus' => $faker->randomElement(['1', '2', '3', '4']),
        'caseDetail' => $faker->text(),
        'address' => $faker->address,
        'Latitude' => $faker->latitude($min = -90, $max = 9),
        'Longitude' => $faker->longitude($min = -180, $max = 180),
        'note' => $faker->sentence(),
        'image' => 'https://picsum.photos/500/300?random=1'.rand(10,100)
    ];
});
