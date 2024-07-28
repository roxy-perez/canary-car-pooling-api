<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\UserCar;
use App\Models\User;
use App\Models\Car;

class UserCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the user_cars table to clear any existing data
        UserCar::truncate();

        // Get all users and cars
        $users = User::all();
        $cars = Car::all();

        // Initialize Faker
        $faker = Faker::create();

        // Associate each user with a random car
        foreach ($users as $user) {
            // Get a random car
            $car = $cars->random();

            // Create the UserCar relationship
            UserCar::create([
                'user_id' => $user->id,
                'car_id' => $car->id,
                'car_registration_number' => strtoupper($faker->bothify('??######')),
                'car_color' => $faker->safeColorName(),
            ]);
        }
    }
}
