<?php

namespace Database\Seeders;

use App\Models\Label;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@taskflow.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Utilisateur classique
        $user = User::factory()->create([
            'name' => 'Jean Dupont',
            'email' => 'user@taskflow.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Utilisateurs supplémentaires
        $users = User::factory(5)->create();

        // Labels
        $labels = Label::factory(8)->create();

        // Projets pour l'admin
        $adminProjects = Project::factory(3)->create(['user_id' => $admin->id]);

        // Projets pour l'utilisateur classique
        $userProjects = Project::factory(2)->create(['user_id' => $user->id]);

        // Projets pour les autres utilisateurs
        foreach ($users as $u) {
            Project::factory(rand(1, 3))->create(['user_id' => $u->id]);
        }

        // Tâches pour chaque projet
        foreach (Project::all() as $project) {
            $tasks = Task::factory(rand(3, 6))->create([
                'project_id' => $project->id,
                'user_id' => $project->user_id,
            ]);

            foreach ($tasks as $task) {
                $task->labels()->attach(
                    $labels->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        }
    }
}
