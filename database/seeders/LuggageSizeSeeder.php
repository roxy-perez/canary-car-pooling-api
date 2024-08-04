<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LuggageSize;

class LuggageSizeSeeder extends Seeder
{
    public function run()
    {
        LuggageSize::truncate();
        $sizes = [
            ['size' => 'Small'],
            ['size' => 'Medium'],
            ['size' => 'Large'],
            ['size' => 'Extra Large'],
            ['size' => 'Oversized'],
        ];

        foreach ($sizes as $size) {
            LuggageSize::create($size);
        }
    }
}
