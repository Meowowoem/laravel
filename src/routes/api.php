<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::controller(TasksController::class)->prefix('tasks')->group( function () {
    Route::post('/', 'addTask');
    Route::get('/', 'getTasks');
    Route::get('/{id}', 'getTask');
    Route::delete('/{id}', 'deleteTask');
    Route::post('/{id}/done', 'closeTask');
});



