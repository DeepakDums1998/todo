<?php

// database/factories/TodoItemFactory.php

namespace Database\Factories;

use App\Models\TodoItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoItemFactory extends Factory
{
    protected $model = TodoItem::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'status' => $this->faker->randomElement(['active', 'completed', 'skipped']),
        ];
    }
}
