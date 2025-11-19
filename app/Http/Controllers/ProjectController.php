<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function create($class)
    {
        $class = strtoupper($class);

        if (!in_array($class, ['A', 'B'])) {
            abort(404);
        }

        $categories = Category::all();

        return view('project-create', compact('class', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class' => 'required|in:A,B',
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'screenshot_1' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'screenshot_2' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'screenshot_3' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'video' => 'required|mimes:mp4,mov,avi,wmv|max:51200',
            'project_link' => 'required|url',
        ]);

        // Upload screenshots
        $screenshot1 = $request->file('screenshot_1')->store('screenshots', 'public');
        $screenshot2 = $request->file('screenshot_2')->store('screenshots', 'public');
        $screenshot3 = $request->file('screenshot_3')->store('screenshots', 'public');

        // Upload video
        $video = $request->file('video')->store('videos', 'public');

        Project::create([
            'class' => $validated['class'],
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'screenshot_1' => $screenshot1,
            'screenshot_2' => $screenshot2,
            'screenshot_3' => $screenshot3,
            'video' => $video,
            'project_link' => $validated['project_link'],
            'status' => 'pending',
        ]);

        return redirect()->route('class.show', strtolower($validated['class']))
            ->with('success', 'Project berhasil ditambahkan! Menunggu persetujuan admin.');
    }
}
