<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('list-user', [UserController::class, 'getAllUsers']);

Route::prefix('scrumboard')->group(function() {
    Route::prefix('project')->group(function() {
        Route::get('/list', [ProjectController::class, 'getAllProjects']);
        Route::post('/create', [ProjectController::class, 'createProject']);
        Route::put('/update/{id}', [ProjectController::class, 'updateProject']);
        Route::delete('/delete/{id}', [ProjectController::class, 'deleteProject']);
    });

    Route::prefix('task')->group(function() {
        Route::get('/list', [TaskController::class, 'getAllTasks']);
        Route::post('/create', [TaskController::class, 'createTask']);
        Route::put('/update/{id}', [TaskController::class, 'updateTask']);
        Route::delete('/delete/{id}', [TaskController::class, 'deleteTask']);
        Route::delete('/project-{projectId}/clear-all', [TaskController::class, 'clearAllTasksInProject']);
    });
});