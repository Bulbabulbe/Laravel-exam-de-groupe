@extends('layouts.app')

@section('title', $task->title)

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projets</a></li>
        <li class="breadcrumb-item"><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></li>
        <li class="breadcrumb-item active">{{ $task->title }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ $task->title }}</h5>
                <div class="btn-group btn-group-sm">
                    <a href="{{ route('projects.tasks.edit', [$project, $task]) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil"></i> Modifier
                    </a>
                    <form method="POST" action="{{ route('projects.tasks.destroy', [$project, $task]) }}"
                          onsubmit="return confirm('Supprimer cette tâche ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-trash"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if($task->description)
                    <p>{{ $task->description }}</p>
                @else
                    <p class="text-muted fst-italic">Aucune description.</p>
                @endif

                @if($task->labels->isNotEmpty())
                    <div class="mb-3">
                        <strong>Labels :</strong>
                        @foreach($task->labels as $label)
                            <span class="badge ms-1" style="background-color: {{ $label->color }}">{{ $label->name }}</span>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">Détails</h6>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-muted">Statut</span>
                    @if($task->status === 'todo')
                        <span class="badge bg-secondary">À faire</span>
                    @elseif($task->status === 'in_progress')
                        <span class="badge bg-info text-dark">En cours</span>
                    @else
                        <span class="badge bg-success">Terminé</span>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-muted">Priorité</span>
                    @if($task->priority === 'high')
                        <span class="text-danger fw-bold"><i class="bi bi-arrow-up-circle-fill"></i> Haute</span>
                    @elseif($task->priority === 'medium')
                        <span class="text-warning fw-bold"><i class="bi bi-dash-circle-fill"></i> Moyenne</span>
                    @else
                        <span class="text-success fw-bold"><i class="bi bi-arrow-down-circle-fill"></i> Basse</span>
                    @endif
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-muted">Créé par</span>
                    <span>{{ $task->user->name }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-muted">Échéance</span>
                    <span>{{ $task->due_date ? $task->due_date->format('d/m/Y') : '-' }}</span>
                </li>
                <li class="list-group-item d-flex justify-content-between">
                    <span class="text-muted">Créé le</span>
                    <span>{{ $task->created_at->format('d/m/Y') }}</span>
                </li>
            </ul>
        </div>

        <div class="mt-3">
            <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-secondary w-100">
                <i class="bi bi-arrow-left"></i> Retour au projet
            </a>
        </div>
    </div>
</div>
@endsection
