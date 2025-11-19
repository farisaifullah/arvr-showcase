@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project: ' . $project->title)

@section('content')

<div class="bg-white/5 backdrop-blur-lg rounded-2xl p-8 border border-white/10">
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" x-data="editProjectForm()">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-2 gap-6">

            <!-- Left Column -->
            <div>
                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold mb-2">
                        Judul Project <span class="text-red-accent-500">*</span>
                    </label>
                    <input type="text"
                           name="title"
                           id="title"
                           value="{{ old('title', $project->title) }}"
                           class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                           required>
                    @error('title')
                        <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Class -->
                <div class="mb-6">
                    <label for="class" class="block text-sm font-semibold mb-2">
                        Kelas <span class="text-red-accent-500">*</span>
                    </label>
                    <select name="class"
                            id="class"
                            class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                            required>
                        <option value="A" {{ old('class', $project->class) == 'A' ? 'selected' : '' }}>Kelas A</option>
                        <option value="B" {{ old('class', $project->class) == 'B' ? 'selected' : '' }}>Kelas B</option>
                    </select>
                    @error('class')
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
                            <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Status -->
                <div class="mb-6">
                    <label for="status" class="block text-sm font-semibold mb-2">
                        Status <span class="text-red-accent-500">*</span>
                    </label>
                    <select name="status"
                            id="status"
                            class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                            required>
                        <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ old('status', $project->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ old('status', $project->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                    @error('status')
                        <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Project Link -->
                <div class="mb-6">
                    <label for="project_link" class="block text-sm font-semibold mb-2">
                        Link Project <span class="text-red-accent-500">*</span>
                    </label>
                    <input type="url"
                           name="project_link"
                           id="project_link"
                           value="{{ old('project_link', $project->project_link) }}"
                           class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                           required>
                    @error('project_link')
                        <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Right Column -->
            <div>
                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold mb-2">
                        Deskripsi <span class="text-red-accent-500">*</span>
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="8"
                              class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                              required>{{ old('description', $project->description) }}</textarea>
                    @error('description')
                        <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Current Project Link -->
                <div class="mb-6">
                    <a href="{{ route('project.show', $project->id) }}"
                       target="_blank"
                       class="inline-flex items-center text-orange-vibrant-500 hover:text-orange-vibrant-400 text-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                        </svg>
                        View Project on Site
                    </a>
                </div>
            </div>

        </div>

        <!-- Screenshots -->
        <div class="mb-6 mt-8">
            <label class="block text-sm font-semibold mb-4">
                Screenshot Project (Biarkan kosong jika tidak ingin mengubah)
            </label>
            <div class="grid md:grid-cols-3 gap-4">

                <!-- Screenshot 1 -->
                <div>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->screenshot_1) }}"
                             alt="Current Screenshot 1"
                             class="w-full h-40 object-cover rounded-lg border-2 border-white/20">
                    </div>
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-white/20 rounded-lg p-4 text-center hover:border-orange-vibrant-500 transition"
                             :class="newScreenshot1 ? 'border-orange-vibrant-500' : ''">
                            <div x-show="!newScreenshot1">
                                <svg class="w-8 h-8 mx-auto mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                <p class="text-xs text-gray-400">Upload New</p>
                            </div>
                            <div x-show="newScreenshot1">
                                <img :src="newScreenshot1" class="w-full h-20 object-cover rounded-lg mb-1">
                                <p class="text-xs text-green-400">✓ New Image</p>
                            </div>
                        </div>
                        <input type="file"
                               name="screenshot_1"
                               accept="image/*"
                               class="hidden"
                               @change="previewImage($event, 'newScreenshot1')">
                    </label>
                    @error('screenshot_1')
                        <p class="text-red-accent-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Screenshot 2 -->
                <div>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->screenshot_2) }}"
                             alt="Current Screenshot 2"
                             class="w-full h-40 object-cover rounded-lg border-2 border-white/20">
                    </div>
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-white/20 rounded-lg p-4 text-center hover:border-orange-vibrant-500 transition"
                             :class="newScreenshot2 ? 'border-orange-vibrant-500' : ''">
                            <div x-show="!newScreenshot2">
                                <svg class="w-8 h-8 mx-auto mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                <p class="text-xs text-gray-400">Upload New</p>
                            </div>
                            <div x-show="newScreenshot2">
                                <img :src="newScreenshot2" class="w-full h-20 object-cover rounded-lg mb-1">
                                <p class="text-xs text-green-400">✓ New Image</p>
                            </div>
                        </div>
                        <input type="file"
                               name="screenshot_2"
                               accept="image/*"
                               class="hidden"
                               @change="previewImage($event, 'newScreenshot2')">
                    </label>
                    @error('screenshot_2')
                        <p class="text-red-accent-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Screenshot 3 -->
                <div>
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $project->screenshot_3) }}"
                             alt="Current Screenshot 3"
                             class="w-full h-40 object-cover rounded-lg border-2 border-white/20">
                    </div>
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-white/20 rounded-lg p-4 text-center hover:border-orange-vibrant-500 transition"
                             :class="newScreenshot3 ? 'border-orange-vibrant-500' : ''">
                            <div x-show="!newScreenshot3">
                                <svg class="w-8 h-8 mx-auto mb-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                </svg>
                                <p class="text-xs text-gray-400">Upload New</p>
                            </div>
                            <div x-show="newScreenshot3">
                                <img :src="newScreenshot3" class="w-full h-20 object-cover rounded-lg mb-1">
                                <p class="text-xs text-green-400">✓ New Image</p>
                            </div>
                        </div>
                        <input type="file"
                               name="screenshot_3"
                               accept="image/*"
                               class="hidden"
                               @change="previewImage($event, 'newScreenshot3')">
                    </label>
                    @error('screenshot_3')
                        <p class="text-red-accent-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>
        </div>

        <!-- Video -->
        <div class="mb-8">
            <label class="block text-sm font-semibold mb-2">
                Video Demo (Biarkan kosong jika tidak ingin mengubah)
            </label>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-400 mb-2">Current Video:</p>
                    <video controls class="w-full rounded-lg border-2 border-white/20" style="max-height: 200px;">
                        <source src="{{ asset('storage/' . $project->video) }}" type="video/mp4">
                    </video>
                </div>
                <div>
                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-white/20 rounded-lg p-8 text-center hover:border-orange-vibrant-500 transition h-full flex items-center justify-center"
                             :class="newVideo ? 'border-orange-vibrant-500' : ''">
                            <div>
                                <div x-show="!newVideo">
                                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="text-gray-400">Upload New Video</p>
                                    <p class="text-xs text-gray-500 mt-1">Max 50MB</p>
                                </div>
                                <div x-show="newVideo" class="text-green-400">
                                    <svg class="w-12 h-12 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="font-semibold">New video selected!</p>
                                    <p class="text-xs mt-1" x-text="newVideoName"></p>
                                </div>
                            </div>
                        </div>
                        <input type="file"
                               name="video"
                               accept="video/*"
                               class="hidden"
                               @change="handleVideo($event)">
                    </label>
                    @error('video')
                        <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="flex gap-4">
            <button type="submit"
                    class="bg-gradient-to-r from-orange-vibrant-600 to-red-accent-600 hover:from-orange-vibrant-500 hover:to-red-accent-500 px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-orange-vibrant-500/50 transition-all duration-300">
                Update Project
            </button>
            <a href="{{ route('admin.projects.index') }}"
               class="px-8 py-3 bg-white/10 hover:bg-white/20 rounded-xl font-semibold transition">
                Cancel
            </a>
        </div>

    </form>
</div>

@push('scripts')
<script>
function editProjectForm() {
    return {
        newScreenshot1: null,
        newScreenshot2: null,
        newScreenshot3: null,
        newVideo: null,
        newVideoName: '',

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
                this.newVideo = true;
                this.newVideoName = file.name;
            }
        }
    }
}
</script>
@endpush

@endsection
