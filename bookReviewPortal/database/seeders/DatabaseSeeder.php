<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Database\Seeder;
use Random\RandomException;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * @throws RandomException
     */
    public function run(): void
    {
        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(5, 30);
            Review::factory($numReviews)
                ->average()
                ->for($book)
                ->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(5, 30);
            Review::factory($numReviews)->bad()->for($book)->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $numReviews = random_int(5, 30);
            Review::factory($numReviews)->good()->for($book)->create();
        });
    }

}
