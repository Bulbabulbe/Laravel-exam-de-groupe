<?php

namespace Database\Factories;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Label>
 */
class LabelFactory extends Factory
{
    public function definition(): array
    {
        $labels = [
            ['name' => 'Bug', 'color' => '#dc3545'],
            ['name' => 'Feature', 'color' => '#0d6efd'],
            ['name' => 'Urgent', 'color' => '#ffc107'],
            ['name' => 'Design', 'color' => '#6f42c1'],
            ['name' => 'Backend', 'color' => '#198754'],
            ['name' => 'Frontend', 'color' => '#0dcaf0'],
            ['name' => 'Testing', 'color' => '#fd7e14'],
            ['name' => 'Documentation', 'color' => '#6c757d'],
        ];

        $pick = fake()->unique()->randomElement($labels);

        return [
            'name' => $pick['name'],
            'color' => $pick['color'],
        ];
    }
}
