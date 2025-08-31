<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Book Reviews - @yield('title')</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio"></script>

  {{-- blade-formatter-disable --}}
  <style type="text/tailwindcss">
    .btn {
      @apply bg-white rounded-md px-4 py-2 text-center font-medium text-slate-500 shadow-sm ring-1 ring-slate-700/10 hover:bg-slate-50 h-10;
    }

    .input {
      @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none rounded-md border-slate-300;
    }

    .filter-container {
      @apply mb-4 flex space-x-2 rounded-md bg-slate-100 p-2;
    }

    .filter-item {
      @apply flex w-full items-center justify-center rounded-md px-4 py-2 text-center text-sm font-medium text-slate-500;
    }

    .filter-item-active {
      @apply bg-white shadow-sm text-slate-800 flex w-full items-center justify-center rounded-md px-4 py-2 text-center text-sm font-medium;
    }

    .book-item {
      @apply text-sm rounded-md bg-white p-4 leading-6 text-slate-900 shadow-md shadow-black/5 ring-1 ring-slate-700/10;
    }

    .book-title {
      @apply text-lg font-semibold text-slate-800 hover:text-slate-600;
    }

    .book-author {
      @apply block text-slate-600;
    }

    .book-rating {
      @apply text-sm font-medium text-slate-700;
    }

    .book-review-count {
      @apply text-xs text-slate-500;
    }

    .empty-book-item {
      @apply text-sm rounded-md bg-white py-10 px-4 text-center leading-6 text-slate-900 shadow-md shadow-black/5 ring-1 ring-slate-700/10;
    }

    .empty-text {
      @apply font-medium text-slate-500;
    }

    .reset-link {
      @apply text-slate-500 underline;
    }
  </style>
  {{-- blade-formatter-enable --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body class="">
  <nav class="bg-gray-800 text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 md:flex md:justify-between md:items-center">
            
            <!-- Logo and Mobile Menu Button Container -->
            <div class="flex justify-between items-center">
                <a href="{{ route('books.index') }}" class="text-2xl font-bold text-gray-100 hover:text-gray-300 rounded-md">
                    Book Review
                </a>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-button" type="button" class="text-gray-100 hover:text-gray-300 focus:outline-none focus:text-gray-300 md:hidden">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <div id="nav-links" class="flex-col md:flex md:flex-row md:items-center md:space-x-4 mt-4 md:mt-0 hidden">
                @guest
                  <a href="/login" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Login</a>
                  <a href="/register" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-gray-700">Register</a>
                  @endguest
                  
                @auth  
                  <p class="text-sm">{{ auth()->user()->name }}</p>
                  <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <x-form-button class="bg-gray-800 hover:bg-gray-700">Logout</x-form-button>
                  </form>
                @endauth
            </div>

        </div>
    </nav>


  <div class="container mx-auto mt-10 mb-10 max-w-3xl">
    @yield('content')
  </div>

  
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const navLinks = document.getElementById('nav-links');

            mobileMenuButton.addEventListener('click', () => {
                // Toggle the 'hidden' class to show/hide the navigation links
                navLinks.classList.toggle('hidden');
            });
        });
    </script>
</body>

</html>