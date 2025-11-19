@extends('layouts.admin')

@section('title', 'Manage Projects')
@section('page-title', 'Manage Projects')

@section('content')

<div class="mb-6">
    <div class="flex items-center justify-between">
        <p class="text-gray-300">Total: {{ $projects->total() }} projects</p>

        <!-- Filter -->
        <div class="flex gap-2" x-data="{ status: 'all' }">
            <select class="bg-white/10 border border-white/20 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-vibrant-500">
                <option value="all">All Status</option>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="rejected">Rejected</option>
            </select>
        </div>
    </div>
</div>

<div class="bg-white/5 backdrop-blur-lg rounded-2xl border border-white/10 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-white/5">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Project</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Class</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Category</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @forelse($projects as $project)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . $project->screenshot_1) }}"
                                     alt="{{ $project->title }}"
                                     class="w-16 h-16 rounded-lg object-cover mr-4">
                                <div>
                                    <p class="font-semibold">{{ $project->title }}</p>
                                    <p class="text-sm text-gray-400">{{ Str::limit($project->description, 50) }}</p>
                                </div>
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
                            @if($project->status === 'pending')
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

                                @if($project->status !== 'approved')
                                    <form action="{{ route('admin.projects.approve', $project) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="bg-green-600 hover:bg-green-500 px-3 py-1 rounded-lg text-xs transition">
                                            ✓
                                        </button>
                                    </form>
                                @endif

                                @if($project->status !== 'rejected')
                                    <form action="{{ route('admin.projects.reject', $project) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit"
                                                class="bg-yellow-600 hover:bg-yellow-500 px-3 py-1 rounded-lg text-xs transition">
                                            ✕
                                        </button>
                                    </form>
                                @endif

                                <a href="{{ route('admin.projects.edit', $project) }}"
                                   class="bg-orange-vibrant-600 hover:bg-orange-vibrant-500 px-3 py-1 rounded-lg text-xs transition">
                                    Edit
                                </a>

                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus project ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-accent-600 hover:bg-red-accent-500 px-3 py-1 rounded-lg text-xs transition">
                                        Delete
                                    </button>
                                </form>
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

<!-- Pagination -->
<div class="mt-6">
    {{ $projects->links() }}
</div>

@endsection
