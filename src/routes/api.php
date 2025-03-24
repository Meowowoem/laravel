<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::post('/tasks/create', [TasksController::class, 'addTask']);
Route::get('/tasks', [TasksController::class, 'getTasks']);
Route::get('/tasks/{id}', [TasksController::class, 'getTask']);
Route::delete('/tasks/delete/{id}', [TasksController::class, 'deleteTask']);
Route::put('/tasks/done/{id}', [TasksController::class, 'closeTask']);

