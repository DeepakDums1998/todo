<?php

// database/factories/TodoFactory.php

namespace Database\Factories;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TodoFactory extends Factory
{
    protected $model = Todo::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'priority' => $this->faker->randomElement(['high', 'normal', 'low']),
            'status' => 'active', // default status
            'user_id' => User::factory(), // Assumes the Todo belongs to a user
        ];
    }
}
