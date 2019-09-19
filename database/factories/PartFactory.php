<?php

use Faker\Generator as Faker;

$factory->define(App\Part::class, function (Faker $faker) {
    return [
    	    'number'       => $faker->numberBetween(1000,20000),
    	    'description'  => $faker->text(300),
            'brand_name'   => $faker->word,
            'qty'          => $faker->numberBetween(0,10000),
            'price'		   => $faker->randomFloat(2,0,90000),
            'condition'	   => $faker->word,
            'location'	   => $faker->randomLetter.$faker->randomDigit 	

    ];
});
