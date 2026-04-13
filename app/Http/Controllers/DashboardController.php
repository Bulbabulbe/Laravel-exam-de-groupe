<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $projects      = Project::with('tasks')->latest()->take(5)->get();
            $totalProjects = Project::count();
            $totalTasks    = Task::count();
            $doneTasks     = Task::where('status', 'done')->count();
        } else {
            $projects      = Project::where('user_id', $user->id)->with('tasks')->latest()->take(5)->get();
            $totalProjects = Project::where('user_id', $user->id)->count();
            $totalTasks    = Task::where('user_id', $user->id)->count();
            $doneTasks     = Task::where('user_id', $user->id)->where('status', 'done')->count();
        }

        return view('dashboard', compact('projects', 'totalProjects', 'totalTasks', 'doneTasks'));
    }
}
