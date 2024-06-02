<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class MunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Municipio::truncate();
        $csv = fopen(database_path('data/municipios.csv'), 'r');
        $firstline = true;
        while (($row = fgetcsv($csv)) !== false) {
            if (!$firstline) {
                if (count($row) >= 3) {
                    Municipio::create([
                        'code' => $row[0],
                        'name' => $row[1],
                        'provincia_id' => $row[2],
                    ]);
                } else {
                    // Handle the case where there are not enough columns in the row
                    // For example, you could log a warning message
                    Log::warning('Not enough columns in row: ' . implode(',', $row));
                }
            }
            $firstline = false;
        }
        fclose($csv);
    }
}
