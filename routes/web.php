<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('todos', TodoController::class);

    Route::patch('/todos/{todo}/status', [TodoController::class, 'updateStatus'])->name('todos.updateStatus');
    Route::patch('/todos/{todo}/items/{item}/status', [TodoController::class, 'updateItemStatus'])->name('todos.updateItemStatus');
});
