<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // generate 100 books and each of those have at least 5 reviews, but not more than 30
        Book::factory(33)->create()->each(function ($book) {
            $numOfReviews = random_int(5, 30);

            Review::factory()->count($numOfReviews)->good()->for($book)->create();
        });

        Book::factory(33)->create()->each(function ($book) {
            $numOfReviews = random_int(5, 30);

            Review::factory()->count($numOfReviews)->average()->for($book)->create();
        });

        Book::factory(34)->create()->each(function ($book) {
            $numOfReviews = random_int(5, 30);

            Review::factory()->count($numOfReviews)->bad()->for($book)->create();
        });

    }
}
