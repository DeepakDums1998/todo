<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\TodoItem;
use Illuminate\Http\Request;

/**
 *
 */
class TodoController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
        // Ensure the user is authenticated before accessing the todo-related actions
        $this->middleware('auth');
    }

    // Show the form to create a new Todo

    /**
     * @return \Illuminate\Container\Container|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View|mixed|object|string|null
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * @param Request $request
     * @param Todo $todo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, Todo $todo)
    {
        // Ensure that the todo belongs to the authenticated user
        if ($todo->user_id !== auth()->id()) {
            return redirect()->route('todos.index');
        }

        // Update the status of the todo based on the request
        $todo->status = $request->status;
        $todo->save();

        // Redirect back to the todos list
        return redirect()->route('todos.index')->with('success', 'Todo status updated!');
    }

    // Store the new Todo in the database

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'priority' => 'required|string|in:high,normal,low',
            'item_titles' => 'required|array|min:1',
            'item_titles.*' => 'required|string|max:25',
        ]);

        // Create the Todo
        $todo = Todo::create([
            'title' => $request->title,
            'priority' => $request->priority,
            'user_id' => auth()->id(),
        ]);

        // Create Todo items
        foreach ($request->item_titles as $item_title) {
            $todo->todoItems()->create([
                'title' => $item_title,
            ]);
        }

        return redirect()->route('todos.index')->with('success', 'Todo and Todo Items created successfully!');
    }

    /**
     * @return \Illuminate\Container\Container|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View|mixed|object|string|null
     */
    public function index()
    {
        $todos = Todo::with('todoItems')
            ->where('user_id', auth()->id())
            ->where(function ($query) {
                $query->where('status', 'active')
                    ->orWhere(function ($query) {
                        $query->whereIn('status', ['completed', 'skipped'])
                            ->whereDate('created_at', '>=', now()->subDays(7));
                    });
            })
            ->orderByRaw("FIELD(priority, 'high', 'normal', 'low')")
            ->get();

        return view('todos.index', compact('todos'));
    }

    /**
     * @param Request $request
     * @param $todoId
     * @param $itemId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateItemStatus(Request $request, $todoId, $itemId)
    {
        $item = TodoItem::findOrFail($itemId);

        // Update the Todo item's status
        $item->status = $request->status;
        $item->save();

        return redirect()->route('todos.index')->with('success', 'Todo item status updated successfully!');
    }
}
