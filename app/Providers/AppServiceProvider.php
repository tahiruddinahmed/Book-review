<?php

namespace App\Providers;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use App\Policies\BookPolicy;
use App\Policies\ReviewPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('review-auth', function(User $user, Review $review) {    
            return $user->id === $review->user_id;
        });

        Gate::define('review-create', function(User $user, Book $book) {
            $check = Review::where([
                'user_id' => $user->id,
                'book_id' => $book->id
            ])->exists();

            return !$check;
        });

        Gate::policy(Book::class, BookPolicy::class);
    }
}
