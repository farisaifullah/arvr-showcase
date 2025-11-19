<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProjects = Project::count();
        $pendingProjects = Project::where('status', 'pending')->count();
        $approvedProjects = Project::where('status', 'approved')->count();
        $totalCategories = Category::count();

        $recentProjects = Project::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProjects',
            'pendingProjects',
            'approvedProjects',
            'totalCategories',
            'recentProjects'
        ));
    }
}