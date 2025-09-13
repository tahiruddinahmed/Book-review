<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // list all the books a author has 
    public function index(Author $author) {
         

        return view('Author.books', ['author' => $author->load('books')]);
    }

}
