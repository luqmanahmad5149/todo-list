<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\UserController;
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

Route::post('/login', [UserController::class, 'login']);

// Login via Google
// Route::get('/auth/google', [GoogleController::class, 'googleAuth']);
// Route::get('/auth/google/callback', [GoogleController::class, 'googleAuthCallback']);

// Route::middleware('auth:sanctum')->group(function() {

// });