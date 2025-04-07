<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(TasksController::class)->prefix('tasks')->group(function () {
    Route::post('/', 'addTask')->middleware('auth:sanctum');
    Route::get('/', 'getTasks')->middleware('auth:sanctum');
    Route::get('/{id}', 'getTask')->middleware('auth:sanctum');
    Route::delete('/{id}', 'deleteTask')->middleware('auth:sanctum');
    Route::post('/{id}/done', 'closeTask')->middleware('auth:sanctum');
});

Route::post('/registration', [LoginController::class, 'registration']);
Route::post('/login', [LoginController::class, 'login']);
