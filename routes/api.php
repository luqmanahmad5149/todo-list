<?php

use App\Http\Controllers\Api\V1\GoogleController;
use App\Http\Controllers\Api\V1\ToDoController;
use App\Http\Controllers\Api\V1\UserController;
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

// v1 API collection
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\Api\V1'], function() {
    // Login API
    Route::post('/login', [UserController::class, 'login']);

    // To-do API's
    Route::middleware('auth:sanctum')->group(function() {
        Route::post('/task', [ToDoController::class, 'postTask']);
        Route::get('/tasks', [ToDoController::class, 'getTasks']);
        Route::put('/task/update', [ToDoController::class, 'updateStatus']);
        Route::delete('/task/delete', [ToDoController::class, 'deleteTask']);
    });
});


// Login via Google
// Route::get('/auth/google', [GoogleController::class, 'googleAuth']);
// Route::get('/auth/google/callback', [GoogleController::class, 'googleAuthCallback']);