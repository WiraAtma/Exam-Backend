<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $books = [];

        for ($i = 0; $i < 100000; $i++) {
            $books[] = [
                'title' => $faker->sentence(3),
                'author_id' => rand(1, 1000),
                'category_id' => rand(1, 3000),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Insert in batches of 1000 to avoid memory issues
            if ($i % 1000 == 0 && $i > 0) {
                DB::table('books')->insert($books);
                $books = [];
            }
        }

        if (!empty($books)) {
            DB::table('books')->insert($books);
        }
    }
}
