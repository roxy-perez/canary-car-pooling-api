<?php

namespace Database\Seeders;

use App\Models\Provincia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProvinciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Provincia::create([
            'code' => '35',
            'name' => 'Las Palmas',
        ]);

        Provincia::create([
            'code' => '38',
            'name' => 'Santa Cruz de Tenerife',
        ]);
    }
}
