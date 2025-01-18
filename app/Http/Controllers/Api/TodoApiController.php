<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoItemStatusRequest;
use App\Http\Requests\UpdateTodoStatusRequest;
use App\Http\Resources\TodoItemResource;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use App\Models\TodoItem;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;

/**
 *
 */
class TodoApiController extends Controller
{
    use ApiResponse; // Use the ApiResponse trait

    /**
     * Get all todos for the authenticated user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todos = Auth::user()->todos()->with('todoItems')->get();

        return $this->success(TodoResource::collection($todos), 'Todos fetched successfully');
    }

    /**
     * Create a new Todo with items.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreTodoRequest $request)
    {
        $todo = Auth::user()->todos()->create([
            'title' => $request->title,
            'priority' => $request->priority,
        ]);

        foreach ($request->item_titles as $itemTitle) {
            $todo->todoItems()->create([
                'title' => $itemTitle,
                'status' => 'active',
            ]);
        }

        return $this->success(new TodoResource($todo), 'Todo created successfully', 201);
    }

    /**
     * Update the status of a Todo (completed/skipped).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(UpdateTodoStatusRequest $request, Todo $todo)
    {
        $todo->update(['status' => $request->status]);

        return $this->success(new TodoResource($todo), 'Todo status updated successfully');
    }

    /**
     * @param UpdateTodoItemStatusRequest $request
     * @param $todoId
     * @param $todoItemId
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateTodoItemStatus(UpdateTodoItemStatusRequest $request, $todoId, $todoItemId)
    {
        // Find the todo item
        $todoItem = TodoItem::where('todo_id', $todoId)->where('id', $todoItemId)->first();

        if (! $todoItem) {
            return response()->json([
                'message' => 'Todo item not found or doesn\'t belong to the specified Todo.',
            ], 404);
        }

        // Update the status of the todo item
        $todoItem->status = $request->status;
        $todoItem->save();

        // Return success response using TodoItemResource
        return $this->success(new TodoItemResource($todoItem), 'Todo item status updated successfully');
    }
}
