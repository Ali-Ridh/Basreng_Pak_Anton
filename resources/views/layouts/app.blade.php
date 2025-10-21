<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }} - Anime & Gaming Forum</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
    <nav class="bg-purple-600 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold">
                        🎮 Anime & Gaming Forum
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="hover:text-purple-200">Login</a>
                        <a href="{{ route('register') }}" class="hover:text-purple-200">Register</a>
                    @else
                        <span class="text-purple-200">Welcome, {{ Auth::user()->name }}!</span>
                        <a href="{{ route('forums.index') }}" class="hover:text-purple-200">Forums</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-purple-200 bg-transparent border-0 text-white cursor-pointer">Logout</button>
                        </form>
                    @endguest
                    <a href="{{ url('/konami') }}" class="text-xs opacity-30 hover:opacity-100" title="Secret Easter Egg">?</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>