<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function showClass($class)
    {
        $class = strtoupper($class);

        if (!in_array($class, ['A', 'B'])) {
            abort(404);
        }

        $projects = Project::with('category')
            ->approved()
            ->byClass($class)
            ->latest()
            ->get();

        $categories = Category::all();

        return view('class', compact('class', 'projects', 'categories'));
    }

    public function showProject($id)
    {
        $project = Project::with('category')->findOrFail($id);

        if ($project->status !== 'approved') {
            abort(404);
        }

        return view('project-detail', compact('project'));
    }
}