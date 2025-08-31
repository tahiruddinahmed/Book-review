<x-auth-layout>
 <div class="bg-gray-800 p-8 rounded-lg shadow-md w-full max-w-sm border border-gray-700">
        <h2 class="text-2xl font-bold text-center mb-6 text-white">Login In</h2>
        <x-form-error name="login"/>
        <form method="POST" action="/login">
            @csrf 
            <div class="mb-4">
                <x-form-label for="email">Email</x-form-label>
                <x-form-input type="email" id="email" name="email" placeholder="Email Address" :value="old('email')" />
                <x-form-error name="email" />
            </div>
            <div class="mb-4">
                <x-form-label for="password">Password</x-form-label>
                <x-form-input type="password" id="password" name="password" placeholder="************" />
                <x-form-error name="password" />
            </div>
            <div class="flex items-center justify-between">
                <x-form-button>Log In</x-form-button>
            </div>
        </form>
        <p class="text-center text-gray-400 text-xs mt-4">
            Don't have an Account? <a href="/register" class="text-blue-400 hover:text-blue-500">Register</a>.
        </p>
        <a href="/" class="mt-4 flex justify-center items-center text-blue-500 bg-gray-300 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Back to Home</a>
    </div>
</x-auth-layout>