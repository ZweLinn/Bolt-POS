<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') === 'Laravel' ? 'Bolt POS' : config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />

    <!-- Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif !important;
        }
        [x-cloak] { display: none !important; }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-900 antialiased min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo & Nav Links -->
                <div class="flex items-center">
                    <a href="{{ url('/user/home') }}" class="flex items-center space-x-2 no-underline group">
                        <i class="fas fa-bolt text-blue-600 text-2xl transition-transform group-hover:scale-110"></i>
                        <span class="text-xl font-bold text-blue-600">Bolt<span class="text-slate-700">POS</span></span>
                    </a>
                    
                    <div class="hidden md:ml-10 md:flex md:space-x-8">
                        <a href="{{ url('/user/home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ Request::is('user/home*') ? 'border-blue-500 text-slate-900' : 'border-transparent text-slate-500 hover:text-blue-600 hover:border-slate-300' }} text-sm font-medium transition no-underline">
                            Shop
                        </a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-blue-600 hover:border-slate-300 transition no-underline">
                            Orders
                        </a>
                        <a href="#" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-blue-600 hover:border-slate-300 transition no-underline">
                            Contact
                        </a>
                    </div>
                </div>

                <!-- Right Side Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Cart -->
                    <a href="#" class="relative p-2 text-slate-500 hover:text-blue-600 transition group">
                        <i class="fa-solid fa-shopping-bag text-xl"></i>
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-[10px] font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-full border-2 border-white">0</span>
                    </a>

                    <!-- Profile Dropdown -->
                    <div class="relative ml-3" x-data="{ open: false }">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center space-x-3 focus:outline-none group">
                            <div class="flex flex-col items-end hidden sm:flex">
                                <span class="text-sm font-semibold text-slate-700 group-hover:text-blue-600 transition">{{ Auth::user()->name ?? 'User' }}</span>
                                <span class="text-[10px] text-slate-400 uppercase tracking-widest">Customer</span>
                            </div>
                            <div class="h-9 w-9 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-500 overflow-hidden group-hover:border-blue-300 transition shadow-sm">
                                @if(Auth::user() && Auth::user()->image)
                                    <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="" class="h-full w-full object-cover">
                                @else
                                    <i class="fas fa-user text-sm"></i>
                                @endif
                            </div>
                        </button>

                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-48 rounded-xl shadow-xl py-1 bg-white ring-1 ring-black ring-opacity-5 z-50 overflow-hidden border border-slate-100">
                            
                            <div class="px-4 py-2 bg-slate-50 border-b border-slate-100 mb-1">
                                <p class="text-[10px] text-slate-400 uppercase font-bold tracking-tighter">Account</p>
                                <p class="text-xs font-medium text-slate-900 truncate">{{ Auth::user()->email ?? '' }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 no-underline transition">
                                <i class="fas fa-user-circle opacity-50 text-xs"></i> <span>Profile</span>
                            </a>
                            <a href="#" class="flex items-center space-x-2 px-4 py-2 text-sm text-slate-700 hover:bg-blue-50 hover:text-blue-600 no-underline transition">
                                <i class="fas fa-history opacity-50 text-xs"></i> <span>My Orders</span>
                            </a>
                            
                            <div class="border-t border-slate-100 my-1"></div>
                            
                            <form action="{{ route('logout') }}" method="post" class="m-0">
                                @csrf
                                <button type="submit" class="w-full text-left flex items-center space-x-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 no-underline transition border-none bg-transparent">
                                    <i class="fas fa-sign-out-alt opacity-50 text-xs"></i> <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    @include('sweetalert::alert')

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div class="col-span-1 md:col-span-2">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2 no-underline mb-6">
                        <i class="fas fa-bolt text-blue-600 text-2xl"></i>
                        <span class="text-xl font-bold text-blue-600">Bolt<span class="text-slate-700">POS</span></span>
                    </a>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm">
                        Simplifying business management with modern POS solutions. Track sales, manage inventory, and grow your customer base with ease.
                    </p>
                    <div class="flex space-x-4 mt-8">
                        <a href="#" class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition"><i class="fab fa-facebook-f text-xs"></i></a>
                        <a href="#" class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition"><i class="fab fa-twitter text-xs"></i></a>
                        <a href="#" class="h-8 w-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 hover:bg-blue-600 hover:text-white transition"><i class="fab fa-instagram text-xs"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-xs font-bold text-slate-900 uppercase tracking-widest mb-6">Explore</h4>
                    <ul class="space-y-3 p-0 list-none">
                        <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 no-underline transition">Our Shop</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 no-underline transition">Categories</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 no-underline transition">Promotion</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-xs font-bold text-slate-900 uppercase tracking-widest mb-6">Support</h4>
                    <ul class="space-y-3 p-0 list-none">
                        <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 no-underline transition">Help Center</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 no-underline transition">Contact Us</a></li>
                        <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 no-underline transition">Returns</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-100 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} Bolt POS. Built with excellence.</p>
                <div class="flex space-x-8 mt-4 md:mt-0">
                    <a href="#" class="hover:text-slate-600 transition no-underline">Privacy Policy</a>
                    <a href="#" class="hover:text-slate-600 transition no-underline">Terms & Conditions</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top -->
    <button id="back-to-top" class="fixed bottom-8 right-8 h-10 w-10 bg-blue-600 text-white rounded-full shadow-lg items-center justify-center hidden hover:bg-blue-700 transition-all transform hover:scale-110 focus:outline-none">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        const backToTop = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 400) {
                backToTop.classList.remove('hidden');
                backToTop.classList.add('flex');
            } else {
                backToTop.classList.add('hidden');
                backToTop.classList.remove('flex');
            }
        });
        backToTop.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    </script>

    @stack('scripts')
</body>
</html>
