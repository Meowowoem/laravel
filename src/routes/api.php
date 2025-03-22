<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::post('/tasks', [TasksController::class, 'addTask']);
