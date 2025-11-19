@extends('layouts.app')

@section('title', 'Admin Login')

@section('content')
    <div class="min-h-screen flex items-center justify-center px-4 py-12">

        <div class="w-full max-w-md">

            <!-- Logo/Title -->
            <div class="text-center mb-8">
                <h1
                    class="text-4xl font-bold mb-2 bg-gradient-to-r from-orange-vibrant-500 to-red-accent-500 bg-clip-text text-transparent">
                    Admin Login
                </h1>
                <p class="text-gray-300">Masuk untuk mengelola project</p>
            </div>

            <!-- Login Form -->
            <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10">
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Email -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-semibold mb-2">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                            required autofocus>
                        @error('email')
                            <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold mb-2">Password</label>
                        <input type="password" name="password" id="password"
                            class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                            required>
                        @error('password')
                            <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember"
                                class="w-4 h-4 text-orange-vibrant-600 bg-white/10 border-white/20 rounded focus:ring-orange-vibrant-500">
                            <span class="ml-2 text-sm text-gray-300">Ingat saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-orange-vibrant-600 to-red-accent-600 hover:from-orange-vibrant-500 hover:to-red-accent-500 px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-orange-vibrant-500/50 transition-all duration-300 transform hover:scale-105">
                        Login
                    </button>

                </form>

                <!-- Back to Home -->
                <div class="mt-6 text-center">
                    <a href="{{ route('home') }}"
                        class="text-sm text-orange-vibrant-500 hover:text-orange-vibrant-400 transition">
                        ← Kembali ke Beranda
                    </a>
                </div>
            </div>

            <!-- Default Credentials Info (for development) -->
            <div
                class="mt-6 bg-purple-deep-800/50 backdrop-blur-lg rounded-xl p-4 border border-purple-deep-600/30 text-sm">
                <p class="font-semibold mb-2">Default Admin Credentials:</p>
                <p class="text-gray-300">Email: <code class="text-orange-vibrant-400">admin@arvr.com</code></p>
                <p class="text-gray-300">Password: <code class="text-orange-vibrant-400">password</code></p>
            </div>

        </div>

    </div>
@endsection
