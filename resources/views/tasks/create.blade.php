@extends('layouts.app')

@section('title', 'Nouvelle tâche')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projets</a></li>
                <li class="breadcrumb-item"><a href="{{ route('projects.show', $project) }}">{{ $project->name }}</a></li>
                <li class="breadcrumb-item active">Nouvelle tâche</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-plus-circle"></i> Créer une tâche</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('projects.tasks.store', $project) }}">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title"
                               name="title"
                               value="{{ old('title') }}"
                               placeholder="Ex: Créer la page d'accueil"
                               required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description"
                                  name="description"
                                  rows="3"
                                  placeholder="Détails de la tâche...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="status" class="form-label">Statut <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="todo" {{ old('status', 'todo') === 'todo' ? 'selected' : '' }}>À faire</option>
                                <option value="in_progress" {{ old('status') === 'in_progress' ? 'selected' : '' }}>En cours</option>
                                <option value="done" {{ old('status') === 'done' ? 'selected' : '' }}>Terminé</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="priority" class="form-label">Priorité <span class="text-danger">*</span></label>
                            <select class="form-select @error('priority') is-invalid @enderror" id="priority" name="priority">
                                <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>Basse</option>
                                <option value="medium" {{ old('priority', 'medium') === 'medium' ? 'selected' : '' }}>Moyenne</option>
                                <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>Haute</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="due_date" class="form-label">Date d'échéance</label>
                            <input type="date"
                                   class="form-control @error('due_date') is-invalid @enderror"
                                   id="due_date"
                                   name="due_date"
                                   value="{{ old('due_date') }}">
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    @if($labels->isNotEmpty())
                    <div class="mb-4">
                        <label class="form-label">Labels</label>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($labels as $label)
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       name="labels[]"
                                       value="{{ $label->id }}"
                                       id="label_{{ $label->id }}"
                                       {{ in_array($label->id, old('labels', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="label_{{ $label->id }}">
                                    <span class="badge" style="background-color: {{ $label->color }}">{{ $label->name }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @error('labels')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> Créer la tâche
                        </button>
                        <a href="{{ route('projects.show', $project) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x"></i> Annuler
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
