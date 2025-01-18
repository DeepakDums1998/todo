<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoApiController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->group(function () {
    // Fetch all Todos for the authenticated user
    Route::get('todos', [TodoApiController::class, 'index']);

    // Store a new Todo
    Route::post('todos', [TodoApiController::class, 'store']);

    // Update the status of a Todo (completed/skipped)
    Route::patch('todos/{todo}/status', [TodoApiController::class, 'updateStatus']);
    Route::patch('todos/{todoId}/items/{todoItemId}/status', [TodoApiController::class, 'updateTodoItemStatus']);
});
