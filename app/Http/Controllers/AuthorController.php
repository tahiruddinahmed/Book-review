<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // list all the books a author has 
    public function index(Author $author) {

        // load the withAvgRating() and withReviewsCount from Book model 
        $author->load(['books' => function ($query) {
            return $query->latest()->withAvgRating()->withReviewsCount();
        }]);

        return view('Author.books', [
            'author' => $author,
            'books' => $author->books
        ]);
    }

}
