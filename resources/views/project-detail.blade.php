@extends('layouts.app')

@section('title', $project->title . ' - AR/VR Showcase')

@section('content')
    <div class="container mx-auto px-4 py-12">

        <!-- Back Button -->
        <a href="{{ route('class.show', strtolower($project->class)) }}"
            class="inline-flex items-center text-orange-vibrant-500 hover:text-orange-vibrant-400 mb-8 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Kelas {{ $project->class }}
        </a>

        <div class="grid lg:grid-cols-3 gap-8">

            <!-- Main Content -->
            <div class="lg:col-span-2">

                <!-- Title & Category -->
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="bg-orange-vibrant-600 px-4 py-1 rounded-full text-sm font-semibold">
                            {{ $project->category->name }}
                        </span>
                        <span class="bg-purple-deep-700 px-4 py-1 rounded-full text-sm font-semibold">
                            Kelas {{ $project->class }}
                        </span>
                    </div>
                    <h1
                        class="text-4xl font-bold mb-4 bg-gradient-to-r from-orange-vibrant-500 to-red-accent-500 bg-clip-text text-transparent">
                        {{ $project->title }}
                    </h1>
                </div>

                <!-- Screenshots Gallery -->
                <div class="mb-8" x-data="{ activeImage: 0 }">
                    <!-- Main Image -->
                    <div
                        class="relative h-96 rounded-2xl overflow-hidden mb-4 bg-gradient-to-br from-purple-deep-800 to-purple-deep-900">
                        <img :src="activeImage === 0 ? '{{ asset('storage/' . $project->screenshot_1) }}' :
                            activeImage === 1 ? '{{ asset('storage/' . $project->screenshot_2) }}' :
                            '{{ asset('storage/' . $project->screenshot_3) }}'"
                            alt="{{ $project->title }}" class="w-full h-full object-contain">
                    </div>

                    <!-- Thumbnails -->
                    <div class="grid grid-cols-3 gap-4">
                        <button @click="activeImage = 0" :class="activeImage === 0 ? 'ring-4 ring-orange-vibrant-500' : ''"
                            class="relative h-24 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $project->screenshot_1) }}" alt="Screenshot 1"
                                class="w-full h-full object-cover">
                        </button>
                        <button @click="activeImage = 1" :class="activeImage === 1 ? 'ring-4 ring-orange-vibrant-500' : ''"
                            class="relative h-24 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $project->screenshot_2) }}" alt="Screenshot 2"
                                class="w-full h-full object-cover">
                        </button>
                        <button @click="activeImage = 2" :class="activeImage === 2 ? 'ring-4 ring-orange-vibrant-500' : ''"
                            class="relative h-24 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $project->screenshot_3) }}" alt="Screenshot 3"
                                class="w-full h-full object-cover">
                        </button>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10 mb-8">
                    <h2 class="text-2xl font-bold mb-4">Deskripsi Project</h2>
                    <p class="text-gray-300 leading-relaxed">{{ $project->description }}</p>
                </div>

                <!-- Video Demo -->
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10">
                    <h2 class="text-2xl font-bold mb-4">Video Demo</h2>
                    <div class="relative rounded-xl overflow-hidden bg-black">
                        <video controls class="w-full" controlsList="nodownload">
                            <source src="{{ asset('storage/' . $project->video) }}" type="video/mp4">
                            Browser Anda tidak mendukung tag video.
                        </video>
                    </div>
                </div>

            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">

                <!-- Project Link -->
                <div
                    class="bg-gradient-to-br from-orange-vibrant-600 to-red-accent-600 rounded-2xl p-8 mb-6 shadow-xl sticky top-4">
                    <h3 class="text-xl font-bold mb-4">Akses Project</h3>
                    <a href="{{ $project->project_link }}" target="_blank"
                        class="block w-full bg-white text-orange-vibrant-600 hover:bg-gray-100 text-center font-semibold py-3 rounded-xl transition transform hover:scale-105">
                        Buka Project
                        <svg class="w-5 h-5 inline ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                    </a>
                </div>

                <!-- Project Info -->
                <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10">
                    <h3 class="text-xl font-bold mb-4">Informasi Project</h3>

                    <div class="space-y-4">
                        <div>
                            <div class="text-sm text-gray-400 mb-1">Kategori</div>
                            <div class="font-semibold">{{ $project->category->name }}</div>
                        </div>

                        <div>
                            <div class="text-sm text-gray-400 mb-1">Kelas</div>
                            <div class="font-semibold">Kelas {{ $project->class }}</div>
                        </div>

                        <div>
                            <div class="text-sm text-gray-400 mb-1">Tanggal Ditambahkan</div>
                            <div class="font-semibold">{{ $project->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
