@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-speedometer2"></i> Tableau de bord</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau projet
    </a>
</div>

@php
    $user = auth()->user();
    if ($user->isAdmin()) {
        $projects = \App\Models\Project::with('tasks')->latest()->take(5)->get();
        $totalProjects = \App\Models\Project::count();
        $totalTasks = \App\Models\Task::count();
        $doneTasks = \App\Models\Task::where('status', 'done')->count();
    } else {
        $projects = \App\Models\Project::where('user_id', $user->id)->with('tasks')->latest()->take(5)->get();
        $totalProjects = \App\Models\Project::where('user_id', $user->id)->count();
        $totalTasks = \App\Models\Task::where('user_id', $user->id)->count();
        $doneTasks = \App\Models\Task::where('user_id', $user->id)->where('status', 'done')->count();
    }
@endphp

<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Projets</h6>
                    <h2 class="mb-0">{{ $totalProjects }}</h2>
                </div>
                <i class="bi bi-folder-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-info">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Tâches totales</h6>
                    <h2 class="mb-0">{{ $totalTasks }}</h2>
                </div>
                <i class="bi bi-list-task fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="card-title">Tâches terminées</h6>
                    <h2 class="mb-0">{{ $doneTasks }}</h2>
                </div>
                <i class="bi bi-check-circle-fill fs-1 opacity-50"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-folder"></i> Projets récents</h5>
        <a href="{{ route('projects.index') }}" class="btn btn-sm btn-outline-primary">Voir tout</a>
    </div>
    <div class="card-body">
        @if($projects->isEmpty())
            <p class="text-muted text-center py-3">Aucun projet pour le moment.</p>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Statut</th>
                            <th>Tâches</th>
                            <th>Créé le</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                        <tr>
                            <td><strong>{{ $project->name }}</strong></td>
                            <td>
                                @if($project->status === 'active')
                                    <span class="badge bg-success">Actif</span>
                                @elseif($project->status === 'completed')
                                    <span class="badge bg-primary">Terminé</span>
                                @else
                                    <span class="badge bg-secondary">Archivé</span>
                                @endif
                            </td>
                            <td>{{ $project->tasks->count() }}</td>
                            <td>{{ $project->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('projects.show', $project) }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
