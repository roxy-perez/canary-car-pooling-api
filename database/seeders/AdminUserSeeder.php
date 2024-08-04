<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica si ya existe el rol de admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);

        $adminUser = User::firstOrCreate(
            ['email' => 'admin@carpooling.com'],
            [
                'full_name' => 'Admin User',
                'password' => Hash::make('password'), // Contraseña por defecto
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );
    }
}
