@extends('layouts.app')

@section('title', 'AR/VR Showcase - Home')

@section('content')
<div class="container mx-auto px-4 py-20">

    <!-- Hero Section -->
    <div class="text-center mb-16">
        <h1 class="text-6xl font-bold mb-6 bg-gradient-to-r from-orange-vibrant-500 via-red-accent-500 to-cyan-400 bg-clip-text text-transparent animate-pulse">
            Showcase AR/VR
        </h1>
        <p class="text-xl text-gray-300 mb-12">
            Jelajahi project AR dan VR yang menakjubkan dari mahasiswa kami
        </p>

        <!-- Class Selection Buttons -->
        <div class="flex flex-col sm:flex-row gap-8 justify-center items-center">

            <!-- Kelas A -->
            <a href="{{ route('class.show', 'a') }}"
               class="group relative w-64 h-64 bg-gradient-to-br from-orange-vibrant-600 to-red-accent-600 rounded-3xl shadow-2xl hover:shadow-orange-vibrant-500/50 transition-all duration-300 transform hover:scale-105 overflow-hidden">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                <div class="relative h-full flex flex-col items-center justify-center p-8">
                    <div class="text-8xl font-bold mb-4 drop-shadow-2xl">A</div>
                    <div class="text-xl font-semibold">Kelas A</div>
                    <div class="mt-4 text-sm opacity-80 group-hover:opacity-100 transition">Lihat Project →</div>
                </div>
                <!-- Decorative elements -->
                <div class="absolute -bottom-16 -right-16 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                <div class="absolute top-4 right-4 w-16 h-16 bg-white/5 rounded-full blur-xl"></div>
            </a>

            <!-- Kelas B - NEW COLORS -->
            <a href="{{ route('class.show', 'b') }}"
               class="group relative w-64 h-64 bg-gradient-to-br from-cyan-500 via-blue-500 to-indigo-600 rounded-3xl shadow-2xl hover:shadow-cyan-500/50 transition-all duration-300 transform hover:scale-105 overflow-hidden">
                <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition"></div>
                <div class="relative h-full flex flex-col items-center justify-center p-8">
                    <div class="text-8xl font-bold mb-4 drop-shadow-2xl">B</div>
                    <div class="text-xl font-semibold">Kelas B</div>
                    <div class="mt-4 text-sm opacity-80 group-hover:opacity-100 transition">Lihat Project →</div>
                </div>
                <!-- Decorative elements -->
                <div class="absolute -top-16 -left-16 w-32 h-32 bg-white/10 rounded-full blur-2xl group-hover:scale-150 transition-transform"></div>
                <div class="absolute bottom-4 left-4 w-16 h-16 bg-white/5 rounded-full blur-xl"></div>
            </a>

        </div>
    </div>

    <!-- Features Section -->
    <div class="grid md:grid-cols-3 gap-8 mt-20">
        <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-orange-vibrant-600/20 hover:border-orange-vibrant-600/50 transition-all hover:transform hover:-translate-y-2">
            <div class="text-4xl mb-4">🥽</div>
            <h3 class="text-xl font-semibold mb-2 text-orange-vibrant-400">Augmented Reality</h3>
            <p class="text-gray-300">Eksplorasi project AR yang memadukan dunia nyata dengan elemen digital</p>
        </div>

        <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-cyan-500/20 hover:border-cyan-500/50 transition-all hover:transform hover:-translate-y-2">
            <div class="text-4xl mb-4">🎮</div>
            <h3 class="text-xl font-semibold mb-2 text-cyan-400">Virtual Reality</h3>
            <p class="text-gray-300">Masuki dunia virtual yang imersif dan interaktif</p>
        </div>

        <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-red-accent-600/20 hover:border-red-accent-600/50 transition-all hover:transform hover:-translate-y-2">
            <div class="text-4xl mb-4">🚀</div>
            <h3 class="text-xl font-semibold mb-2 text-red-accent-400">Inovasi Mahasiswa</h3>
            <p class="text-gray-300">Karya terbaik dari mahasiswa berbakat kami</p>
        </div>
    </div>

</div>
@endsection
