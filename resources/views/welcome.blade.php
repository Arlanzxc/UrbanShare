<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UrbanShare - Tool Rental Marketplace</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-900 text-gray-300 flex flex-col min-h-screen">

    <nav class="p-6 flex justify-between items-center border-b border-gray-800 bg-gray-900/50 backdrop-blur-sm fixed w-full top-0 z-50">
        <div class="text-2xl font-bold text-white tracking-wider">
            Urban<span class="text-blue-500">Share</span>
        </div>
        
        <div>
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('items.index') }}" class="font-semibold text-gray-300 hover:text-white transition mr-4">Catalog</a>
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-300 hover:text-white transition">Dashboard</a>
                @else
                    <a href="{{ route('items.index') }}" class="font-semibold text-gray-300 hover:text-white transition mr-6">Catalog</a>
                    <a href="{{ route('login') }}" class="font-semibold text-gray-300 hover:text-white transition mr-4">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <main class="flex-grow flex flex-col items-center justify-center px-4 text-center mt-20">
        <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-6">
            Rent the tools you need.<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500">Share the ones you don't.</span>
        </h1>
        <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl">
            UrbanShare is your local peer-to-peer marketplace for renting tools and construction equipment. Save money, reduce waste, and build something great.
        </p>
        
        <div class="flex flex-col sm:flex-row gap-4">
            <a href="{{ route('items.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition text-lg">
                Browse Catalog
            </a>
            <a href="{{ route('register') }}" class="bg-gray-800 hover:bg-gray-700 border border-gray-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition text-lg">
                Start Earning
            </a>
        </div>
    </main>

    <footer class="py-6 text-center text-sm text-gray-500 border-t border-gray-800 mt-auto">
        &copy; {{ date('Y') }} UrbanShare. All rights reserved.
    </footer>

</body>
</html>