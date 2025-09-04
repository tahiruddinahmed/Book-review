<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('Books.Reviews.create', ['book' => $book]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request, Book $book)
    {   
        $data = $request->validated();
        $book->reviews()->create([
            ...$data,
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('books.show', ['book' => $book])->with('success', 'A review is added to this book');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, Review $review)
    {
        // authorize the user 
        Gate::authorize('review-update', $review);
        // return a view 

        return view('Books.Reviews.edit', [
            'book' => $book,
            'review' => $review
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, Book $book, Review $review)
    {
        // Authorize the user 
        Gate::authorize('review-update', $review);

        // validate form data 
        $data = $request->validated();
        // update record 
        $review->update([
            ...$data,
            'user_id' => $request->user()->id
        ]);

        // redirect
        return redirect()->route('books.show', $book); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
