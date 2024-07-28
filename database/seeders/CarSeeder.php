<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate the cars table to clear any existing data
        Car::truncate();

        // Path to the CSV files directory
        $csvDirectory = database_path('data/cars');

        // Get all CSV files in the directory
        $csvFiles = glob($csvDirectory . '/*.csv');

        DB::beginTransaction();

        try {
            foreach ($csvFiles as $csvFile) {
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
                        if (count($row) >= 4) {
                            // Create a new car record in the database
                            Car::create([
                                'year' => $row[0],
                                'make' => $row[1],
                                'model' => $row[2],
                                'body_styles' => $row[3],
                                'comfort_level' => $this->determineComfortLevel($row[2])
                            ]);
                        } else {
                            // Handle the case where there are not enough columns in the row
                            Log::warning('Not enough columns in row: ' . implode(',', $row));
                        }
                    }

                    // Close the CSV file
                    fclose($csv);
                } else {
                    Log::error("Failed to open CSV file: $csvFile");
                }
            }

            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            Log::error("Failed to seed cars table: " . $ex->getMessage());
        }
    }

    /**
     * Determine the comfort level for a car model.
     *
     * @param string $model
     * @return int
     */
    private function determineComfortLevel(string $model): int
    {
        // Define comfort level logic
        $luxuryModels = ['Lexus', 'Mercedes-Benz', 'BMW', 'Audi', 'Tesla'];
        $midRangeModels = ['Toyota', 'Honda', 'Ford', 'Chevrolet', 'Nissan'];

        if (in_array($model, $luxuryModels)) {
            return 5;
        } elseif (in_array($model, $midRangeModels)) {
            return 3;
        } else {
            return 1;
        }
    }
}
