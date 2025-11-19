@extends('layouts.app')

@section('title', 'Kelas ' . $class . ' - AR/VR Showcase')

@section('content')
<div class="container mx-auto px-4 py-12">

    <!-- Back Button -->
    <a href="{{ route('home') }}"
       class="inline-flex items-center text-orange-vibrant-500 hover:text-orange-vibrant-400 mb-6 group transition-all">
        <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        <span class="font-semibold">Kembali ke Pilihan Kelas</span>
    </a>

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12 gap-4">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <h1 class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-orange-vibrant-500 to-red-accent-500 bg-clip-text text-transparent">
                    Kelas {{ $class }}
                </h1>
                @if($class == 'A')
                    <span class="px-4 py-2 bg-gradient-to-r from-orange-vibrant-600 to-red-accent-600 rounded-full text-sm font-semibold">
                        Class A
                    </span>
                @else
                    <span class="px-4 py-2 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full text-sm font-semibold">
                        Class B
                    </span>
                @endif
            </div>
            <p class="text-gray-300">
                <span class="font-semibold text-orange-vibrant-400">{{ $projects->count() }}</span> Project Tersedia
            </p>
        </div>

        <a href="{{ route('project.create', strtolower($class)) }}"
           class="w-full md:w-auto bg-gradient-to-r from-orange-vibrant-600 to-red-accent-600 hover:from-orange-vibrant-500 hover:to-red-accent-500 px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-orange-vibrant-500/50 transition-all duration-300 transform hover:scale-105 text-center">
            <span class="inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Tambah Project
            </span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-500/20 border border-green-500 text-green-100 px-6 py-4 rounded-xl mb-8 flex items-start" x-data="{ show: true }" x-show="show">
            <svg class="w-6 h-6 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <p class="font-semibold mb-1">Berhasil!</p>
                <p>{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="text-green-100 hover:text-white ml-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Category Filter -->
    <div class="mb-8">
        <div class="bg-white/5 backdrop-blur-lg rounded-xl p-4 border border-white/10">
            <p class="text-sm text-gray-400 mb-3 font-semibold">Filter by Category:</p>
            <div class="flex flex-wrap gap-3" x-data="{ activeCategory: 'all' }">
                <button @click="activeCategory = 'all'"
                        :class="activeCategory === 'all' ? 'bg-orange-vibrant-600 shadow-lg' : 'bg-white/10 hover:bg-white/20'"
                        class="px-6 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 category-filter font-semibold"
                        data-category="all">
                    <span class="inline-flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                        </svg>
                        Semua
                    </span>
                </button>
                @foreach($categories as $category)
                    <button @click="activeCategory = '{{ $category->slug }}'"
                            :class="activeCategory === '{{ $category->slug }}' ? 'bg-orange-vibrant-600 shadow-lg' : 'bg-white/10 hover:bg-white/20'"
                            class="px-6 py-2 rounded-lg transition-all duration-300 transform hover:scale-105 category-filter font-semibold"
                            data-category="{{ $category->slug }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    @if($projects->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
                <a href="{{ route('project.show', $project->id) }}"
                   class="group bg-white/5 backdrop-blur-lg rounded-2xl overflow-hidden border border-white/10 hover:border-orange-vibrant-600/50 transition-all duration-300 hover:shadow-2xl hover:shadow-orange-vibrant-600/20 transform hover:-translate-y-2 project-card"
                   data-category="{{ $project->category->slug }}">

                    <!-- Thumbnail -->
                    <div class="relative h-48 overflow-hidden bg-gradient-to-br from-purple-deep-800 to-purple-deep-900">
                        <img src="{{ asset('storage/' . $project->screenshot_1) }}"
                             alt="{{ $project->title }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <!-- Category Badge -->
                        <div class="absolute top-4 right-4 bg-orange-vibrant-600 px-3 py-1 rounded-full text-sm font-semibold shadow-lg">
                            {{ $project->category->name }}
                        </div>

                        <!-- Class Badge -->
                        <div class="absolute top-4 left-4 {{ $class == 'A' ? 'bg-red-accent-600' : 'bg-cyan-600' }} px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                            Kelas {{ $project->class }}
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 group-hover:text-orange-vibrant-500 transition line-clamp-2">
                            {{ $project->title }}
                        </h3>
                        <p class="text-gray-400 text-sm line-clamp-2 mb-4">
                            {{ $project->description }}
                        </p>

                        <div class="flex items-center justify-between">
                            <span class="text-orange-vibrant-500 text-sm font-semibold flex items-center">
                                Lihat Detail
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                </svg>
                            </span>
                            <span class="text-xs text-gray-500">
                                {{ $project->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-20">
            <div class="bg-white/5 backdrop-blur-lg rounded-3xl p-12 border border-white/10 max-w-md mx-auto">
                <div class="text-6xl mb-6">📦</div>
                <h3 class="text-2xl font-bold mb-2">Belum Ada Project</h3>
                <p class="text-gray-400 mb-6">Belum ada project di kelas {{ $class }} saat ini</p>
                <a href="{{ route('project.create', strtolower($class)) }}"
                   class="inline-block bg-gradient-to-r from-orange-vibrant-600 to-red-accent-600 hover:from-orange-vibrant-500 hover:to-red-accent-500 px-8 py-3 rounded-xl transition-all transform hover:scale-105 font-semibold shadow-lg">
                    Jadilah yang pertama menambahkan project!
                </a>
            </div>
        </div>
    @endif

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.category-filter');
    const projectCards = document.querySelectorAll('.project-card');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category');

            projectCards.forEach(card => {
                if (category === 'all' || card.getAttribute('data-category') === category) {
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, 10);
                } else {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
});
</script>
@endpush
@endsection
