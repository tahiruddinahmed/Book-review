@extends('Components.layout')

@section('title', 'Add review')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add Book</h2>

    <form class="space-y-5" method="POST" action="{{ route('book.store') }}">
        @csrf

        <!-- title Field -->
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
            <input type="text" name="title" id="title" placeholder="enter book title..."
                value="{{ old('title') }}"
                class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"    
            />


            <x-form-error name="title" />
        </div>

        <!-- author Field -->
        <div>
            <label for="author" class="block text-sm font-medium text-gray-700 mb-1">Author</label>
            <select id="author" name="author_id"
                class="w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="" disabled {{ old('author_id') ? '' : 'selected' }}>Select Author</option>
                @forelse ($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') === $author->id ? 'selected' : '' }}>{{ $author->name }} </option>
                @empty
                    <a href="">Add a new author</a>
                @endforelse
            </select>
            <x-form-error name='author_id' />
        </div>


        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-md shadow transition duration-200">
                Add Book
            </button>
        </div>

    </form>
</div>
@endsection