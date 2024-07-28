<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Municipio;
use App\Models\Ride;
use App\Models\UserCar;
use App\Models\LuggageSize;
use Faker\Factory as Faker;

class RideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ride::truncate();

        $faker = Faker::create();
        $userCars = UserCar::all();
        $municipios = Municipio::all();
        $luggageSizes = LuggageSize::all();

        foreach ($userCars as $userCar) {
            for ($i = 0; $i < 5; $i++) {
                Ride::create([
                    'user_car_id' => $userCar->id,
                    'created_on' => $faker->dateTimeThisYear(),
                    'travel_start_time' => $faker->dateTimeBetween('now', '+1 month'),
                    'source_municipio_id' => $municipios->random()->id,
                    'destination_municipio_id' => $municipios->random()->id,
                    'seats_offered' => $faker->numberBetween(1, 4),
                    'contribution_per_head' => $faker->randomFloat(2, 5, 50),
                    'luggage_size_id' => $luggageSizes->random()->id,
                    'is_recurring' => $faker->boolean,
                ]);
            }
        }
    }
}
