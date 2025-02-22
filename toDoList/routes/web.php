<?php

    use App\Http\Controllers\TaskController;
    use Illuminate\Support\Facades\Route;

Route::resource('tasks', TaskController::class);
Route::post('tasks/{task}/toggle', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
