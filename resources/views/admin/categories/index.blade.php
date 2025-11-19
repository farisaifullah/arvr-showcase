@extends('layouts.admin')

@section('title', 'Manage Categories')
@section('page-title', 'Manage Categories')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    <!-- Add Category Form -->
    <div class="lg:col-span-1">
        <div class="bg-white/5 backdrop-blur-lg rounded-2xl p-6 border border-white/10 sticky top-6">
            <h3 class="text-xl font-bold mb-6">Add New Category</h3>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold mb-2">
                        Category Name <span class="text-red-accent-500">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           placeholder="e.g., Mixed Reality"
                           class="w-full bg-white/10 border border-white/20 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500 focus:border-transparent transition"
                           required>
                    @error('name')
                        <p class="text-red-accent-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit"
                        class="w-full bg-gradient-to-r from-orange-vibrant-600 to-red-accent-600 hover:from-orange-vibrant-500 hover:to-red-accent-500 px-6 py-3 rounded-xl font-semibold shadow-lg transition-all duration-300">
                    Add Category
                </button>
            </form>

            <div class="mt-6 p-4 bg-blue-600/20 border border-blue-600/30 rounded-lg">
                <p class="text-sm text-blue-300">
                    <strong>Note:</strong> Default categories are AR and VR. You can add more categories like Mixed Reality, 360° Video, etc.
                </p>
            </div>
        </div>
    </div>

    <!-- Categories List -->
    <div class="lg:col-span-2">
        <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-white/10 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/10">
                <h3 class="text-xl font-bold">All Categories</h3>
            </div>

            <div class="divide-y divide-white/10">
                @forelse($categories as $category)
                    <div class="p-6 hover:bg-white/5 transition" x-data="{ editing: false, editName: '{{ $category->name }}' }">

                        <!-- View Mode -->
                        <div x-show="!editing" class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-gradient-to-br from-orange-vibrant-600 to-red-accent-600 rounded-xl flex items-center justify-center text-2xl mr-4">
                                    {{ substr($category->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg">{{ $category->name }}</h4>
                                    <p class="text-sm text-gray-400">{{ $category->projects_count }} projects</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <button @click="editing = true"
                                        class="bg-orange-vibrant-600 hover:bg-orange-vibrant-500 px-4 py-2 rounded-lg text-sm transition">
                                    Edit
                                </button>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini? Kategori dengan project tidak bisa dihapus.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-accent-600 hover:bg-red-accent-500 px-4 py-2 rounded-lg text-sm transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Edit Mode -->
                        <form x-show="editing"
                              action="{{ route('admin.categories.update', $category) }}"
                              method="POST"
                              class="flex items-center gap-4">
                            @csrf
                            @method('PUT')

                            <input type="text"
                                   name="name"
                                   x-model="editName"
                                   class="flex-1 bg-white/10 border border-white/20 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500"
                                   required>

                            <button type="submit"
                                    class="bg-green-600 hover:bg-green-500 px-4 py-2 rounded-lg text-sm transition">
                                Save
                            </button>

                            <button type="button"
                                    @click="editing = false; editName = '{{ $category->name }}'"
                                    class="bg-gray-600 hover:bg-gray-500 px-4 py-2 rounded-lg text-sm transition">
                                Cancel
                            </button>
                        </form>

                    </div>
                @empty
                    <div class="p-8 text-center text-gray-400">
                        Belum ada kategori. Tambahkan kategori pertama Anda!
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@endsection
