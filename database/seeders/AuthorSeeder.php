<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $authors = [];

        // If this seeder can't produce 1,000 data entries in the database,
        // you can try generating data in smaller quantities.
        // For example, 10, 50, 100, 1000, etc.

        for ($i = 0; $i < 1000; $i++) {
            $authors[] = [
                'name' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('authors')->insert($authors);
    }
}
