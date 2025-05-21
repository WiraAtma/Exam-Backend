<?php

namespace Database\Seeders;

use App\Models\Book;
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
        $authorIds = range(1, 1000);
        $categoryIds = range(1, 3000);
        
        $books = [];
        for ($i = 0; $i < 100000; $i++) {
            $books[] = [
                'title' => $faker->sentence(3),
                'author_id' => $authorIds[array_rand($authorIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        foreach (array_chunk($books, 1000) as $chunk) {
            DB::table('books')->insert($chunk);
        }

        // get all rating data : count and average per book
        $stats = DB::table('ratings')
            ->selectRaw('book_id, COUNT(*) as rating_voter, AVG(rating) as average_rating')
            ->groupBy('book_id')
            ->get()
            ->keyBy('book_id');
        
        // Update books with rating count dan average
        Book::chunk(1000, function ($books) use ($stats) {
            foreach ($books as $book) {
                if ($stats->has($book->id)) {
                    $book->rating_voter = $stats[$book->id]->rating_voter;
                    $book->average_rating = round($stats[$book->id]->average_rating, 2);
                    $book->save();
                }
            }
        });
    }
}
