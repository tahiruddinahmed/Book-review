<button type="submit" {{$attributes->merge(['class' => 'bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full'])}}>
    {{ $slot }}
</button>