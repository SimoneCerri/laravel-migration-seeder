<?php

namespace Database\Seeders;
use App\Models\Train;
use Faker\Generator as Faker;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        /* $trains = config('db.trains');
        foreach ($trains as $train)
        {
            $newTrain = new Train();
            $newTrain->company = $train['company'];
            $newTrain->departure_station = $train['departure_station'];
            $newTrain->arrival_station = $train['arrival_station'];
            $newTrain->departure_time = $train['departure_time'];
            $newTrain->arrival_time = $train['arrival_time'];
            $newTrain->train_code = $train['train_code'];
            $newTrain->number_of_carriages = $train['number_of_carriages'];
            $newTrain->on_time = $train['on_time'];
            $newTrain->cancelled = $train['cancelled'];
            //REMEMBER TO SAVE IT
            $newTrain->save();
        } */

        for ($i=0; $i < 50; $i++)
        { 
            $train = new Train();
            $train->company = $faker->regexify('[A-Z]{10}');
            $train->departure_station = $faker->bothify('??????-??????');
            $train->arrival_station = $faker->bothify('??????-??????');
            $train->departure_time = $faker->dateTimeThisMonth();
            $train->arrival_time = $faker->dateTimeThisMonth();
            $train->train_code = $faker->regexify('[A-Z]{2}[0-9]{4}');
            $train->number_of_carriages = $faker->randomDigitNotNull();
            $train->on_time = $faker->boolean();
            $train->cancelled = $faker->boolean();
            //REMEMBER TO SAVE IT
            $train->save();
        }
    }
}
