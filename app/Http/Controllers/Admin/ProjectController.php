<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('category')->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function edit(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'class' => 'required|in:A,B',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'screenshot_1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'screenshot_2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'screenshot_3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video' => 'nullable|mimes:mp4,mov,avi,wmv|max:51200',
            'project_link' => 'required|url',
            'status' => 'required|in:pending,approved,rejected',
        ]);

        // Update screenshots if new ones are uploaded
        if ($request->hasFile('screenshot_1')) {
            Storage::disk('public')->delete($project->screenshot_1);
            $validated['screenshot_1'] = $request->file('screenshot_1')->store('screenshots', 'public');
        }

        if ($request->hasFile('screenshot_2')) {
            Storage::disk('public')->delete($project->screenshot_2);
            $validated['screenshot_2'] = $request->file('screenshot_2')->store('screenshots', 'public');
        }

        if ($request->hasFile('screenshot_3')) {
            Storage::disk('public')->delete($project->screenshot_3);
            $validated['screenshot_3'] = $request->file('screenshot_3')->store('screenshots', 'public');
        }

        // Update video if new one is uploaded
        if ($request->hasFile('video')) {
            Storage::disk('public')->delete($project->video);
            $validated['video'] = $request->file('video')->store('videos', 'public');
        }

        $project->update($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil diupdate!');
    }

    public function destroy(Project $project)
    {
        // Delete associated files
        Storage::disk('public')->delete([
            $project->screenshot_1,
            $project->screenshot_2,
            $project->screenshot_3,
            $project->video,
        ]);

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus!');
    }

    public function approve(Project $project)
    {
        $project->update(['status' => 'approved']);

        return redirect()->back()
            ->with('success', 'Project berhasil disetujui!');
    }

    public function reject(Project $project)
    {
        $project->update(['status' => 'rejected']);

        return redirect()->back()
            ->with('success', 'Project berhasil ditolak!');
    }
}