<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;


    protected $fillable = ['review', 'rating'];

    /**
     * Get the book that this review belongs to.
     *
     * Defines an inverse one-to-many relationship.
     * Each review is associated with a single book.
     */
    public function book() {
        return $this->belongsTo(Book::class);
    }

    protected static function booted() {
        static::updated(fn(Review $review) => cache()->forget('book:' . $review->book_id));
        static::deleted(fn(Review $review) => cache()->forget('book:' . $review->book_id));
    }
}
