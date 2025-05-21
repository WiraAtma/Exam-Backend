<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $batchSize = 1000;

        // If this seeder can't produce 500,000 data entries in the database,
        // you can try generating data in smaller quantities.
        // For example, 10, 50, 100, 1000, etc.
        $totalRatings = 500000;

        for ($i = 0; $i < $totalRatings; $i += $batchSize) {
            $dataBatch = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $dataBatch[] = [
                    'book_id'    => rand(1, 100000),               
                    'rating'     => rand(1, 10), 
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            DB::table('ratings')->insert($dataBatch);
        }
    }
}
