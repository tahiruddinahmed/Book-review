@extends('Components.layout')

@section('title', $book->title)

@section('content')
    <div class="mb-4">
        <h1 class="sticky top-0 mb-2 text-2xl">{{ $book->title }}</h1>

        <div class="book-info">
            <div class="book-author mb-4 text-lg font-semibold">by {{ $book->author }}</div>
            <div class="book-rating flex items-center">
                <div class="mr-2 text-lg font-medium text-slate-700">
                    {{-- {{ number_format($book->reviews_avg_rating, 1) }} --}}
                    <x-star-rating :rating="$book->reviews_avg_rating" />
                </div>
                <span class="book-review-count text-sm mt-1 text-gray-500">
                    {{ $book->reviews_count }} {{ Str::plural('review', 5) }}
                </span>
            </div>
        </div>
    </div>

    <div>
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-6 border-b pb-4">
            <h2 class="text-2xl font-bold text-gray-800">Reviews</h2>

            @auth
                <a href="{{ route('books.review.create', ['book' => $book->id]) }}"
                    class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg shadow transition duration-200">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add Review</span>
                </a>    
            @endauth
            @guest
                <a href="{{ route('login') }}"
                    class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-700 text-white font-medium py-2 px-5 rounded-lg shadow transition duration-200">
                    <span>Login/Create Account to post Review</span>
                </a>
            @endguest
        </div>

        {{-- session alert  --}}
        @if(@session('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <span class="font-medium">{{ session('success') }} </span>
            </div>
        @endsession
        <ul>
            @forelse ($reviews as $review)
                <li class="book-item mb-4">
                    <div>
                        <div class="mb-2 flex items-top justify-between">
                            <div class="font-semibold mb-2 flex items-top gap-4">
                                <div>
                                    <p class="font-bold">{{ $review->user->name }}</p>
                                    <x-star-rating :rating="$review->rating" />
                                </div>
                                <div class="gap-1.5 flex items-top">
                                    @if (Gate::allows('review-auth', $review))
                                        <div>
                                            <a href="{{ route('books.review.edit', ['book' => $book->id, 'review' => $review->id]) }}" class="bg-blue-600 p-1 rounded-md text-white hover:bg-blue-700 transition duration-300 text-sm">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </div>

                                        {{-- delete review --}}
                                        <form action="{{ route('books.review.destroy', [$book, $review]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                             class="bg-red-600 p-1 rounded-md text-white hover:bg-red-700 transition duration-300 text-xs">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                        {{-- <a href=""><i class="fa-solid fa-trash"></i></a> --}}
                                    @endif
                                </div>
                            </div>
                            <div class="book-review-count">
                                {{ $review->created_at->format('M j, Y') }}
                            </div>
                        </div>
                        <p class="text-gray-700">{{ $review->review }}</p>
                    </div>
                </li>
            @empty
                <li class="mb-4">
                    <div class="empty-book-item">
                        <p class="empty-text text-lg font-semibold">No reviews yet</p>
                    </div>
                </li>
            @endforelse
        </ul>

        @if ($reviews->count())
            <nav>
                {{ $reviews->links() }}
            </nav>
        @endif
    </div>
@endsection
