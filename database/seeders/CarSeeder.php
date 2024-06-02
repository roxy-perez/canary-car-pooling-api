<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use Illuminate\Support\Facades\Log;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the cars table to clear any existing data
        Car::truncate();

        // Path to the CSV file
        $csvFile = database_path('data/cars.csv');

        // Check if the file exists before opening
        if (!file_exists($csvFile) || !is_readable($csvFile)) {
            Log::error("CSV file not found or not readable: $csvFile");
            return;
        }

        // Open the CSV file for reading
        if (($csv = fopen($csvFile, 'r')) !== false) {
            $firstline = true;

            // Read each row of the CSV file
            while (($row = fgetcsv($csv)) !== false) {
                // Skip the first line (header) of the CSV file
                if ($firstline) {
                    $firstline = false;
                    continue;
                }

                // Check if the row has the expected number of columns
                if (count($row) >= 5) {
                    // Create a new car record in the database
                    Car::create([
                        'name' => $row[0],
                        'make' => $row[1],
                        'model' => $row[2],
                        'year' => $row[3],
                        'comfort_level' => $row[4],
                    ]);
                } else {
                    // Handle the case where there are not enough columns in the row
                    // For example, you could log a warning message
                    Log::warning('Not enough columns in row: ' . implode(',', $row));
                }
            }

            // Close the CSV file
            fclose($csv);
        } else {
            Log::error("Failed to open CSV file: $csvFile");
        }
    }
}
