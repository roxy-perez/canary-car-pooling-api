<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProvinciaSeeder::class,
            MunicipioSeeder::class,
            LuggageSizeSeeder::class,
            CarSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}
