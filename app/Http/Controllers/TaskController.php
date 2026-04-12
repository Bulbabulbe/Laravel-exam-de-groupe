<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function create(Project $project)
    {
        $this->authorize('view', $project);

        $labels = Label::all();

        return view('tasks.create', compact('project', 'labels'));
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $this->authorize('view', $project);

        $task = $project->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
            'user_id' => auth()->id(),
        ]);

        if ($request->has('labels')) {
            $task->labels()->sync($request->labels);
        }

        return redirect()->route('projects.show', $project)
            ->with('success', 'Tâche créée avec succès.');
    }

    public function show(Project $project, Task $task)
    {
        $this->authorize('view', $project);

        $task->load('labels', 'user');

        return view('tasks.show', compact('project', 'task'));
    }

    public function edit(Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $labels = Label::all();

        return view('tasks.edit', compact('project', 'task', 'labels'));
    }

    public function update(UpdateTaskRequest $request, Project $project, Task $task)
    {
        $this->authorize('update', $task);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ]);

        $task->labels()->sync($request->labels ?? []);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Project $project, Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('projects.show', $project)
            ->with('success', 'Tâche supprimée avec succès.');
    }
}
