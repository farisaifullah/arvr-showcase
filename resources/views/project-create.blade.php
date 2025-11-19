@extends('layouts.app')

@section('title', 'Tambah Project Kelas ' . $class)

@section('content')
<div class="container mx-auto px-4 py-12">

    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('class.show', strtolower($class)) }}"
           class="inline-flex items-center text-orange-vibrant-500 hover:text-orange-vibrant-400 mb-4 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>

        <h1 class="text-4xl font-bold bg-gradient-to-r from-orange-vibrant-500 to-red-accent-500 bg-clip-text text-transparent">
            Tambah Project Baru - Kelas {{ $class }}
        </h1>
        <p class="text-gray-300 mt-2">Isi formulir di bawah untuk menambahkan project Anda</p>
    </div>

    <!-- Form -->
    <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10">
        <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data" x-data="projectForm()">
            @csrf

            <input type="hidden" name="class" value="{{ $class }}">

            <!-- Title -->
            <div class="mb-6">
                <label for="title" class="block text-sm font-semibold mb-2">
                    Judul Project <span class="text-red-accent-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       id="title"
                       value="{{ old('title') }}"
                       class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                       required>
                @error('title')
                    <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div class="mb-6">
                <label for="category_id" class="block text-sm font-semibold mb-2">
                    Kategori <span class="text-red-accent-500">*</span>
                </label>
                <select name="category_id"
                        id="category_id"
                        class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                        required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-semibold mb-2">
                    Deskripsi Singkat <span class="text-red-accent-500">*</span>
                </label>
                <textarea name="description"
                          id="description"
                          rows="5"
                          class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                          required>{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Screenshots -->
            <div class="mb-6">
                <label class="block text-sm font-semibold mb-2">
                    Screenshot Project (3 Foto) <span class="text-red-accent-500">*</span>
                </label>
                <div class="grid md:grid-cols-3 gap-4">

                    <!-- Screenshot 1 -->
                    <div>
                        <label class="block w-full cursor-pointer">
                            <div class="border-2 border-dashed border-white/20 rounded-lg p-6 text-center hover:border-orange-vibrant-500 transition"
                                 :class="screenshot1 ? 'border-orange-vibrant-500' : ''">
                                <div x-show="!screenshot1">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-400">Screenshot 1</p>
                                </div>
                                <div x-show="screenshot1" class="relative">
                                    <img :src="screenshot1" class="w-full h-32 object-cover rounded-lg">
                                    <p class="text-xs text-green-400 mt-2">✓ Uploaded</p>
                                </div>
                            </div>
                            <input type="file"
                                   name="screenshot_1"
                                   accept="image/*"
                                   class="hidden"
                                   @change="previewImage($event, 'screenshot1')"
                                   required>
                        </label>
                        @error('screenshot_1')
                            <p class="text-red-accent-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Screenshot 2 -->
                    <div>
                        <label class="block w-full cursor-pointer">
                            <div class="border-2 border-dashed border-white/20 rounded-lg p-6 text-center hover:border-orange-vibrant-500 transition"
                                 :class="screenshot2 ? 'border-orange-vibrant-500' : ''">
                                <div x-show="!screenshot2">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-400">Screenshot 2</p>
                                </div>
                                <div x-show="screenshot2" class="relative">
                                    <img :src="screenshot2" class="w-full h-32 object-cover rounded-lg">
                                    <p class="text-xs text-green-400 mt-2">✓ Uploaded</p>
                                </div>
                            </div>
                            <input type="file"
                                   name="screenshot_2"
                                   accept="image/*"
                                   class="hidden"
                                   @change="previewImage($event, 'screenshot2')"
                                   required>
                        </label>
                        @error('screenshot_2')
                            <p class="text-red-accent-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Screenshot 3 -->
                    <div>
                        <label class="block w-full cursor-pointer">
                            <div class="border-2 border-dashed border-white/20 rounded-lg p-6 text-center hover:border-orange-vibrant-500 transition"
                                 :class="screenshot3 ? 'border-orange-vibrant-500' : ''">
                                <div x-show="!screenshot3">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-gray-400">Screenshot 3</p>
                                </div>
                                <div x-show="screenshot3" class="relative">
                                    <img :src="screenshot3" class="w-full h-32 object-cover rounded-lg">
                                    <p class="text-xs text-green-400 mt-2">✓ Uploaded</p>
                                </div>
                            </div>
                            <input type="file"
                                   name="screenshot_3"
                                   accept="image/*"
                                   class="hidden"
                                   @change="previewImage($event, 'screenshot3')"
                                   required>
                        </label>
                        @error('screenshot_3')
                            <p class="text-red-accent-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- Video -->
            <div class="mb-6">
                <label for="video" class="block text-sm font-semibold mb-2">
                    Video Demo <span class="text-red-accent-500">*</span>
                </label>
                <label class="block w-full cursor-pointer">
                    <div class="border-2 border-dashed border-white/20 rounded-lg p-8 text-center hover:border-orange-vibrant-500 transition"
                         :class="video ? 'border-orange-vibrant-500' : ''">
                        <div x-show="!video">
                            <svg class="w-16 h-16 mx-auto mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-400">Klik untuk upload video demo</p>
                            <p class="text-xs text-gray-500 mt-1">Max 50MB (MP4, MOV, AVI, WMV)</p>
                        </div>
                        <div x-show="video" class="text-green-400">
                            <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="font-semibold">Video berhasil dipilih!</p>
                            <p class="text-xs mt-1" x-text="videoName"></p>
                        </div>
                    </div>
                    <input type="file"
                           name="video"
                           accept="video/*"
                           class="hidden"
                           @change="handleVideo($event)"
                           required>
                </label>
                @error('video')
                    <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Project Link -->
            <div class="mb-8">
                <label for="project_link" class="block text-sm font-semibold mb-2">
                    Link Project <span class="text-red-accent-500">*</span>
                </label>
                <input type="url"
                       name="project_link"
                       id="project_link"
                       value="{{ old('project_link') }}"
                       placeholder="https://example.com/project"
                       class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                       required>
                @error('project_link')
                    <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex gap-4">
                <button type="submit"
                        class="flex-1 bg-gradient-to-r from-orange-vibrant-600 to-red-accent-600 hover:from-orange-vibrant-500 hover:to-red-accent-500 px-8 py-4 rounded-xl font-semibold shadow-lg hover:shadow-orange-vibrant-500/50 transition-all duration-300 transform hover:scale-105">
                    Kirim Project
                </button>
                <a href="{{ route('class.show', strtolower($class)) }}"
                   class="px-8 py-4 bg-white/10 hover:bg-white/20 rounded-xl font-semibold transition">
                    Batal
                </a>
            </div>

        </form>
    </div>

</div>

@push('scripts')
<script>
function projectForm() {
    return {
        screenshot1: null,
        screenshot2: null,
        screenshot3: null,
        video: null,
        videoName: '',

        previewImage(event, target) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this[target] = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },

        handleVideo(event) {
            const file = event.target.files[0];
            if (file) {
                this.video = true;
                this.videoName = file.name;
            }
        }
    }
}
</script>
@endpush
@endsection
