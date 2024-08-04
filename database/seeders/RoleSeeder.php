<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'driver']);
        Role::create(['name' => 'user']);
    }
}
