@extends('layouts.app')

@section('title', $project->name)

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projets</a></li>
        <li class="breadcrumb-item active">{{ $project->name }}</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h1 class="h3 mb-1">
            {{ $project->name }}
            @if($project->status === 'active')
                <span class="badge bg-success ms-2">Actif</span>
            @elseif($project->status === 'completed')
                <span class="badge bg-primary ms-2">Terminé</span>
            @else
                <span class="badge bg-secondary ms-2">Archivé</span>
            @endif
        </h1>
        <p class="text-muted mb-0">
            <i class="bi bi-person"></i> {{ $project->user->name }}
            &nbsp;|&nbsp;
            <i class="bi bi-calendar"></i> Créé le {{ $project->created_at->format('d/m/Y') }}
        </p>
    </div>
    <div class="btn-group">
        <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nouvelle tâche
        </a>
        <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-primary">
            <i class="bi bi-pencil"></i> Modifier
        </a>
        <form method="POST" action="{{ route('projects.destroy', $project) }}"
              onsubmit="return confirm('Supprimer ce projet et toutes ses tâches ?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger">
                <i class="bi bi-trash"></i> Supprimer
            </button>
        </form>
    </div>
</div>

@if($project->description)
    <div class="card mb-4">
        <div class="card-body">
            <p class="mb-0">{{ $project->description }}</p>
        </div>
    </div>
@endif

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-list-task"></i> Tâches ({{ $tasks->count() }})</h5>
    </div>
    <div class="card-body p-0">
        @if($tasks->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <p class="mt-3 text-muted">Aucune tâche dans ce projet.</p>
                <a href="{{ route('projects.tasks.create', $project) }}" class="btn btn-primary">
                    Créer une tâche
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Titre</th>
                            <th>Statut</th>
                            <th>Priorité</th>
                            <th>Labels</th>
                            <th>Échéance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td>
                                <a href="{{ route('projects.tasks.show', [$project, $task]) }}" class="text-decoration-none fw-medium">
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td>
                                @if($task->status === 'todo')
                                    <span class="badge bg-secondary">À faire</span>
                                @elseif($task->status === 'in_progress')
                                    <span class="badge bg-info text-dark">En cours</span>
                                @else
                                    <span class="badge bg-success">Terminé</span>
                                @endif
                            </td>
                            <td>
                                @if($task->priority === 'high')
                                    <span class="priority-high fw-bold"><i class="bi bi-arrow-up-circle-fill"></i> Haute</span>
                                @elseif($task->priority === 'medium')
                                    <span class="priority-medium fw-bold"><i class="bi bi-dash-circle-fill"></i> Moyenne</span>
                                @else
                                    <span class="priority-low fw-bold"><i class="bi bi-arrow-down-circle-fill"></i> Basse</span>
                                @endif
                            </td>
                            <td>
                                @foreach($task->labels as $label)
                                    <span class="badge" style="background-color: {{ $label->color }}">{{ $label->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @if($task->due_date)
                                    <span class="{{ $task->due_date->isPast() && $task->status !== 'done' ? 'text-danger' : 'text-muted' }}">
                                        {{ $task->due_date->format('d/m/Y') }}
                                    </span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn btn-outline-primary" title="Modifier">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form method="POST" action="{{ route('projects.tasks.destroy', [$project, $task]) }}"
                                          onsubmit="return confirm('Supprimer cette tâche ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger" title="Supprimer">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
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
