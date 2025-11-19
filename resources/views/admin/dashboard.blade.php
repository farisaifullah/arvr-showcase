@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-4 gap-6 mb-8">

        <!-- Total Projects -->
        <div class="bg-gradient-to-br from-orange-vibrant-600 to-red-accent-600 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80 mb-1">Total Projects</p>
                    <h3 class="text-4xl font-bold">{{ $totalProjects }}</h3>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending Projects -->
        <div class="bg-gradient-to-br from-yellow-600 to-orange-600 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80 mb-1">Pending</p>
                    <h3 class="text-4xl font-bold">{{ $pendingProjects }}</h3>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Approved Projects -->
        <div class="bg-gradient-to-br from-green-600 to-emerald-600 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80 mb-1">Approved</p>
                    <h3 class="text-4xl font-bold">{{ $approvedProjects }}</h3>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Categories -->
        <div class="bg-gradient-to-br from-purple-deep-700 to-purple-deep-900 rounded-2xl p-6 shadow-xl">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-80 mb-1">Categories</p>
                    <h3 class="text-4xl font-bold">{{ $totalCategories }}</h3>
                </div>
                <div class="bg-white/20 p-4 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Projects -->
    <div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-white/10 overflow-hidden">
        <div class="px-6 py-4 border-b border-white/10 flex items-center justify-between">
            <h3 class="text-xl font-bold">Recent Projects</h3>
            <a href="{{ route('admin.projects.index') }}"
                class="text-orange-vibrant-500 hover:text-orange-vibrant-400 text-sm font-semibold">
                View All →
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-white/5">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Title</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Class</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Category</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    @forelse($recentProjects as $project)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <img src="{{ asset('storage/' . $project->screenshot_1) }}" alt="{{ $project->title }}"
                                        class="w-12 h-12 rounded-lg object-cover mr-3">
                                    <span class="font-semibold">{{ Str::limit($project->title, 30) }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-purple-deep-700 px-3 py-1 rounded-full text-sm">
                                    Kelas {{ $project->class }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-orange-vibrant-600/30 px-3 py-1 rounded-full text-sm">
                                    {{ $project->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($project->status === 'pending')
                                    <span class="bg-yellow-600/30 text-yellow-400 px-3 py-1 rounded-full text-sm">
                                        Pending
                                    </span>
                                @elseif($project->status === 'approved')
                                    <span class="bg-green-600/30 text-green-400 px-3 py-1 rounded-full text-sm">
                                        Approved
                                    </span>
                                @else
                                    <span class="bg-red-600/30 text-red-400 px-3 py-1 rounded-full text-sm">
                                        Rejected
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">
                                {{ $project->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if ($project->status === 'pending')
                                        <form action="{{ route('admin.projects.approve', $project) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-500 px-3 py-1 rounded-lg text-sm transition">
                                                Approve
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('admin.projects.edit', $project) }}"
                                        class="bg-orange-vibrant-600 hover:bg-orange-vibrant-500 px-3 py-1 rounded-lg text-sm transition">
                                        Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                Belum ada project
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
