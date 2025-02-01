<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
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

Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [UserController::class, 'currentUser']);

    Route::prefix('/users')->group(function () {
        Route::middleware('role:admin')->group(function () {
            // Admin only endpoints
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'create']);
        });
        Route::prefix('/{user}')->group(function () {
            Route::get('/', [UserController::class, 'show']);
            Route::post('/', [UserController::class, 'update']);
            Route::delete('/', [UserController::class, 'destroy']);
        });
    });
});
