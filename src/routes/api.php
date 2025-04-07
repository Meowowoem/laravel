<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\LoginController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->controller(TasksController::class)->prefix('tasks')->group(function () {
    Route::post('/', 'addTask');
    Route::get('/', 'getTasks');
    Route::get('/{id}', 'getTask');
    Route::delete('/{id}', 'deleteTask');
    Route::post('/{id}/done', 'closeTask');
});

Route::post('/registration', [LoginController::class, 'registration']);
Route::post('/login', [LoginController::class, 'login']);
