<?php

// database/seeders/TodoSeeder.php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\TodoItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a sample user (if needed)
        $user = User::factory()->create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'username' => 'demo',
            'password' => bcrypt('password'),
        ]);

        // Create demo todos
        $todos = Todo::factory(5)->create([
            'user_id' => $user->id,
        ]);

        // Create demo todo items for each todo
        $todos->each(function ($todo) {
            TodoItem::factory(3)->create([
                'todo_id' => $todo->id,
            ]);
        });
    }
}
