<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('auth')->group(function() {
    Route::post('register', [ AuthController::class, 'register'])->name('register');
    Route::post('login', [ AuthController::class, 'login'])->name('login');
});

Route::middleware('auth:api')->group(function() {
    Route::apiResource('todos', TodoController::class);
});
