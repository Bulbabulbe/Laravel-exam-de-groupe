@extends('layouts.app')

@section('title', 'Mes Projets')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3"><i class="bi bi-folder"></i> Mes Projets</h1>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouveau projet
    </a>
</div>

@if($projects->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5">
            <i class="bi bi-folder-x fs-1 text-muted"></i>
            <p class="mt-3 text-muted">Aucun projet pour le moment.</p>
            <a href="{{ route('projects.create') }}" class="btn btn-primary">Créer votre premier projet</a>
        </div>
    </div>
@else
    <div class="row g-4">
        @foreach($projects as $project)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h5 class="card-title mb-0">{{ $project->name }}</h5>
                        @if($project->status === 'active')
                            <span class="badge bg-success">Actif</span>
                        @elseif($project->status === 'completed')
                            <span class="badge bg-primary">Terminé</span>
                        @else
                            <span class="badge bg-secondary">Archivé</span>
                        @endif
                    </div>
                    <p class="card-text text-muted small">
                        {{ Str::limit($project->description, 100) }}
                    </p>
                    @if(auth()->user()->isAdmin())
                        <p class="small text-muted mb-2">
                            <i class="bi bi-person"></i> {{ $project->user->name }}
                        </p>
                    @endif
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-light text-dark border">
                            <i class="bi bi-list-task"></i> {{ $project->tasks->count() }} tâche(s)
                        </span>
                    </div>
                </div>
                <div class="card-footer bg-transparent d-flex justify-content-between">
                    <small class="text-muted">{{ $project->created_at->format('d/m/Y') }}</small>
                    <div class="btn-group btn-group-sm">
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-secondary" title="Voir">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('projects.edit', $project) }}" class="btn btn-outline-primary" title="Modifier">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('projects.destroy', $project) }}"
                              onsubmit="return confirm('Supprimer ce projet ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger" title="Supprimer">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>
@endif
@endsection
