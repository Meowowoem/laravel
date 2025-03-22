<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/tasks/{text}', [TasksController::class, 'addTask']);

