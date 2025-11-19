<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - AR/VR Showcase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body
    class="bg-gradient-to-br from-purple-deep-900 via-purple-deep-800 to-purple-deep-700 min-h-screen text-white font-poppins">

    <div class="flex h-screen" x-data="{ sidebarOpen: true }">

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'w-64' : 'w-20'"
            class="bg-black/30 backdrop-blur-lg border-r border-orange-vibrant-600/30 transition-all duration-300 flex flex-col">

            <!-- Logo -->
            <div class="p-6 border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center">
                    <span class="text-2xl">🎮</span>
                    <span x-show="sidebarOpen" class="ml-3 font-bold text-lg">Admin Panel</span>
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-orange-vibrant-600/20 transition {{ request()->routeIs('admin.dashboard') ? 'bg-orange-vibrant-600/30 text-orange-vibrant-400' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Dashboard</span>
                </a>

                <a href="{{ route('admin.projects.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-orange-vibrant-600/20 transition {{ request()->routeIs('admin.projects.*') ? 'bg-orange-vibrant-600/30 text-orange-vibrant-400' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Projects</span>
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-orange-vibrant-600/20 transition {{ request()->routeIs('admin.categories.*') ? 'bg-orange-vibrant-600/30 text-orange-vibrant-400' : '' }}">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">Categories</span>
                </a>

                <a href="{{ route('home') }}"
                    class="flex items-center px-4 py-3 rounded-lg hover:bg-purple-deep-600/20 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-3">View Site</span>
                </a>
            </nav>

            <!-- Toggle Button -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="p-4 border-t border-white/10 hover:bg-white/5 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>

        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Bar -->
            <header class="bg-black/30 backdrop-blur-lg border-b border-orange-vibrant-600/30 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-bold">@yield('page-title', 'Dashboard')</h2>

                    <div class="flex items-center gap-4">
                        <span class="text-gray-300">{{ auth()->user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="bg-red-accent-600 hover:bg-red-accent-500 px-4 py-2 rounded-lg transition">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">

                @if (session('success'))
                    <div class="bg-green-500/20 border border-green-500 text-green-100 px-6 py-4 rounded-xl mb-6"
                        x-data="{ show: true }" x-show="show">
                        <div class="flex items-center justify-between">
                            <span>{{ session('success') }}</span>
                            <button @click="show = false" class="text-green-100 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-500/20 border border-red-500 text-red-100 px-6 py-4 rounded-xl mb-6"
                        x-data="{ show: true }" x-show="show">
                        <div class="flex items-center justify-between">
                            <span>{{ session('error') }}</span>
                            <button @click="show = false" class="text-red-100 hover:text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>

        </div>

    </div>

    @stack('scripts')
</body>

</html>
