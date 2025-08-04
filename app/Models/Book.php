<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    use HasFactory;

    /**
     * Get all reviews for this book.
     *
     * Defines a one-to-many relationship.
     * A single book can have multiple associated reviews.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews() {
        return $this->hasMany(Review::class);
    }


    /**
     * Local query scope 
     * search by title
     */
    public function scopeTitle(Builder $query, string $title): Builder {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    /**
     * Popular Books - get the books that have the most amount of reviews 
     */
    public function scopePopular(Builder $query): Builder {
        return $query->withCount('reviews')->orderBy('reviews_count', 'desc');
    }

    /**
     * Highest Rated Books - sorting books by the reviews average rating
     */
    public function scopeHighestRated(Builder $query): Builder {
        return $query->withAvg('reviews', 'rating')->orderBy('reviews_avg_rating', 'desc');
    }
}
