<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'AR/VR Showcase')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gradient-to-br from-purple-deep-900 via-purple-deep-800 to-purple-deep-700 min-h-screen text-white font-poppins">

    <!-- Navigation -->
    <nav class="bg-black/30 backdrop-blur-lg border-b border-orange-vibrant-600/30 sticky top-0 z-50" x-data="{ mobileMenuOpen: false }">
        <div class="container mx-auto px-4 py-3 lg:py-4">
            <div class="flex items-center justify-between">

                <!-- Left Section: Logos & Title -->
                <div class="flex items-center gap-3 lg:gap-4">
                    <!-- Logo PENS -->
                    <a href="{{ route('home') }}" class="flex-shrink-0">
                        <img src="{{ asset('images/logo-pens.png') }}"
                             alt="PENS Logo"
                             class="h-10 lg:h-14 w-auto hover:scale-110 transition-transform duration-300">
                    </a>

                    <!-- Divider - Hidden on mobile -->
                    <div class="hidden sm:block w-px h-10 lg:h-12 bg-gradient-to-b from-transparent via-orange-vibrant-500 to-transparent"></div>

                    <!-- Logo HCM - Hidden on small mobile -->
                    <a href="{{ route('home') }}" class="flex-shrink-0 hidden sm:block">
                        <img src="{{ asset('images/logo-hcm.png') }}"
                             alt="Human Centric Multimedia"
                             class="h-10 lg:h-14 w-auto hover:scale-110 transition-transform duration-300">
                    </a>

                    <!-- Divider -->
                    <div class="hidden lg:block w-px h-12 bg-gradient-to-b from-transparent via-orange-vibrant-500 to-transparent"></div>

                    <!-- Title - Hidden on mobile -->
                    <a href="{{ route('home') }}" class="hidden lg:block text-xl xl:text-2xl font-bold bg-gradient-to-r from-orange-vibrant-500 to-red-accent-500 bg-clip-text text-transparent hover:from-orange-vibrant-400 hover:to-red-accent-400 transition">
                        AR/VR Showcase
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center gap-4">
                    <a href="{{ route('home') }}"
                       class="hover:text-orange-vibrant-500 transition {{ request()->routeIs('home') ? 'text-orange-vibrant-500 font-semibold' : '' }}">
                        Home
                    </a>

                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                               class="hover:text-orange-vibrant-500 transition {{ request()->routeIs('admin.*') ? 'text-orange-vibrant-500 font-semibold' : '' }}">
                                Dashboard
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-accent-600 hover:bg-red-accent-500 px-4 py-2 rounded-lg transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-orange-vibrant-600 hover:bg-orange-vibrant-500 px-4 py-2 rounded-lg transition">
                            Admin Login
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2 rounded-lg hover:bg-white/10 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen"
                 x-transition
                 class="md:hidden mt-4 pt-4 border-t border-white/10">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('home') }}"
                       class="px-4 py-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('home') ? 'bg-orange-vibrant-600/30 text-orange-vibrant-400' : '' }}">
                        Home
                    </a>

                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                               class="px-4 py-2 rounded-lg hover:bg-white/10 transition {{ request()->routeIs('admin.*') ? 'bg-orange-vibrant-600/30 text-orange-vibrant-400' : '' }}">
                                Dashboard
                            </a>
                        @endif

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 rounded-lg bg-red-accent-600 hover:bg-red-accent-500 transition">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg bg-orange-vibrant-600 hover:bg-orange-vibrant-500 transition text-center">
                            Admin Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer - UPDATED -->
    <footer class="bg-black/50 backdrop-blur-lg mt-20 py-8 border-t border-orange-vibrant-600/30">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-300 mb-2">
                &copy; 2025 AR/VR Showcase
            </p>
            <p class="text-gray-400 text-sm">
                PENS - Human Centric Multimedia
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
