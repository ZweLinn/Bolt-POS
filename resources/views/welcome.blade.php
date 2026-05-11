<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name') === 'Laravel' ? 'POS System' : config('app.name') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased bg-slate-50 text-slate-900">
        <div class="relative min-h-screen flex flex-col">
            <nav class="bg-white border-b border-slate-200">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <span class="text-xl font-bold text-blue-600">Bolt<span class="text-slate-700">POS</span></span>
                        </div>
                        <div class="flex items-center space-x-4">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-700 hover:text-blue-600 transition">Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-700 hover:text-blue-600 transition">Log in</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition shadow-sm">
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </nav>

            <main class="flex-grow flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                <div class="max-w-3xl w-full text-center">
                    <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight text-slate-900 mb-6 leading-tight">
                        Streamline Your Business Operations with Ease
                    </h1>
                    <p class="text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                        Manage your inventory, track sales in real-time, and grow your business with our intuitive point of sale system.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        @auth
                            @if(in_array(auth()->user()->role, ['admin', 'superadmin']))
                                <a href="{{ url('/admin/home') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                                    Go to Dashboard
                                </a>
                            @else
                                <a href="{{ url('/user/home') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                                    Go to Dashboard
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                                Get Started
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-3 border border-slate-300 text-base font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 transition shadow-sm">
                                Create Account
                            </a>
                        @endauth
                    </div>
                </div>
            </main>

            <footer class="bg-white border-t border-slate-200 py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-slate-500 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name') === 'Laravel' ? 'POS System' : config('app.name') }}. All rights reserved.
                </div>
            </footer>
        </div>
    </body>
</html>
