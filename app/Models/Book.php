<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;

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
    public function scopeTitle(Builder $query, string $title): Builder | QueryBuilder {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }

    /**
     * Popular Books - get the books that have the most amount of reviews 
     */
    public function scopePopular(Builder $query, $from = null, $to = null): Builder | QueryBuilder {

        return $query->withCount([
            'reviews' => fn(Builder $q) => $this->dateRageFilter($q, $from, $to) 
        ])->orderBy('reviews_count', 'desc');
    }

    /**
     * Highest Rated Books - sorting books by the reviews average rating
     */
    public function scopeHighestRated(Builder $query, $from = null, $to = null): Builder | QueryBuilder {
        return $query->withAvg([
            'reviews' => fn(Builder $q) => $this->dateRageFilter($q, $from, $to)
        ], 'rating')->orderBy('reviews_avg_rating', 'desc');
    }

    /**
     * Scope a query to only include books with at least the given number of reviews.
     *
     * Note: This scope should be used after applying withCount('reviews') or a similar method
     * that adds the 'reviews_count' column to the query.
     *
     * @param Builder $query
     * @param int $minReviews
     * @return Builder|QueryBuilder
     */
    public function scopeMinReviews(Builder $query, int $minReviews) : Builder | QueryBuilder {
        return $query->having('reviews_count', '>=', $minReviews);
    }

    /**
     * Apply a date range filter to the reviews query.
     *
     * Modifies the given query to filter reviews by their 'created_at' timestamp.
     * - If only $from is provided, filters reviews created after or on $from.
     * - If only $to is provided, filters reviews created before or on $to.
     * - If both are provided, filters reviews created between $from and $to.
     *
     * @param Builder $query
     * @param string|null $from
     * @param string|null $to
     * @return void
     */
    private function dateRageFilter(Builder $query, $from = null, $to = null) {
        if($from && !$to) {
            $query->where('created_at', '>=', $from);
        } else if(!$from && $to) {
            $query->where('created_at', '<=', $to);
        } else if($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    }
}
