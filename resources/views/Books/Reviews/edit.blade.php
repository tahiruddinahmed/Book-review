@extends('Components.layout')

@section('title', 'Add review')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Review</h2>
    <p>Book Title: {{ $book->title }}</p>
    <form class="space-y-5" method="POST" action="{{ route('books.review.update', [$book, $review]) }}">
        @csrf
        @method('PUT')

        <!-- Rating Field -->
        <div>
            <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Rating</label>
            <select id="rating" name="rating"
                class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled {{ old('rating') ? '' : 'selected' }}>Select a rating</option>
                <option value="5" {{ $review->rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                <option value="4" {{ $review->rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                <option value="3" {{ $review->rating == 3 ? 'selected' : '' }}>3 - Good</option>
                <option value="2" {{ $review->rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                <option value="1" {{ $review->rating == 1 ? 'selected' : '' }}>1 - Poor</option>
            </select>


            <x-form-error name="rating" />
        </div>

        <!-- Review Field -->
        <div>
            <label for="review" class="block text-sm font-medium text-gray-700 mb-1">Your Review</label>
            <textarea id="review" name="review" rows="5"
                class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Write your thoughts here...">{{ $review->review }}</textarea>

            <x-form-error name="review" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition duration-200">
                Save Changes
            </button>
        </div>

    </form>
</div>
@endsection