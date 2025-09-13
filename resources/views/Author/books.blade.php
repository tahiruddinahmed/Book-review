@extends('Components.layout')

@section('title', 'Author - Books')


@section('content')
    <h1 class="mb-10 text-2xl font-bold">{{ $author->name }}</h1>

    <ul>
        @forelse ($books as $book)
            <li class="mb-4">
                <div class="book-item">
                    <div class="flex flex-wrap items-center justify-between">
                        <div class="w-full flex-grow sm:w-auto">
                            <a href="{{ route('books.show', ['book' => $book->id]) }}" class="book-title">{{ $book->title }}</a>
                            <span class="book-author">By <a href="{{ route('books.author', $book->author) }}" class="underline">{{ $book->author->name }}</a></span>
                        </div>

                        <div>
                            <div class="book-rating">
                                {{-- {{ number_format($book->reviews_avg_rating, 1) }} --}}
                                <x-star-rating :rating="$book->reviews_avg_rating" />
                            </div>
                            <div class="book-review-count">Out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }} </div>
                        </div>
                    </div>
                </div>
            </li>
        @empty 
            <li class="mb-4">
                <div class="empty-book-item">
                    <p class="empty-text">No book found</p>
                    <a href="{{ route('books.index') }}" class="reset-link">Reset Criteria</a>
                </div>
            </li>
        @endforelse
    </ul>

    {{-- @if($books->count())
        <nav>
            {{ $books->links() }}
        </nav>
    @endif --}}
@endsection