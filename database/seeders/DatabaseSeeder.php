<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Nette\Utils\Random;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 user 
        User::factory(10)->create();
        Author::factory(10)->create();

        $users = User::all();
        $authors = Author::all();

        // generate 100 books and each of those have at least 5 reviews, but not more than 30
        

        Book::factory(33)->create([
            'user_id' => fn() => $users->random()->id,
            'author_id' => fn() => $authors->random()->id
        ])->each(function ($book) use($users) {
            $numOfReviews = random_int(5, 30);            
            
            for($i = 0; $i < $numOfReviews; $i++) {
                $user = $users->random();
                Review::factory()->good()->for($book)->create([
                    'user_id' => $user->id
                ]);
            }
        });

        Book::factory(33)->create([
            'user_id' => fn() => $users->random()->id,
            'author_id' => fn() => $authors->random()->id
        ])->each(function ($book) use ($users) {
            $numOfReviews = random_int(5, 30);

            for($i = 0; $i < $numOfReviews; $i++) {
                $user = $users->random();
                Review::factory()->average()->for($book)->create([
                    'user_id' => $user->id
                ]);
            }
        });

        Book::factory(34)->create([
            'user_id' => fn() => $users->random()->id,
            'author_id' => fn() => $authors->random()->id
        ])->each(function ($book) use ($users) {
            $numOfReviews = random_int(5, 30);

            for($i = 0; $i < $numOfReviews; $i++) {
                $user = $users->random();
                Review::factory()->average()->for($book)->create([
                    'user_id' => $user->id
                ]);
            }
        });

    }
}
