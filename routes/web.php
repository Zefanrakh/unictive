<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\ViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::prefix('/login')->group(function () {
        Route::get('/', [AuthController::class, 'showLoginForm'])->name('auth.login');
        Route::post('/', [AuthController::class, 'login']);
    });
    Route::prefix('/register')->group(function () {
        Route::get('/', [AuthController::class, 'showRegisterForm'])->name('auth.register');
        Route::post('/', [AuthController::class, 'register']);
    });
});

Route::middleware(['auth:web'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [ViewController::class, 'dashboard'])->name('dashboard');
    Route::prefix('/profile')->group(function () {
        Route::get('/', [UserController::class, 'profile'])->name('profile');
        Route::post('/', [UserController::class, 'updateProfile'])->name('profile.update');
    });

    Route::middleware(['roleweb:admin'])->group(function () {
        Route::prefix('/users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'showCreateForm'])->name('users.create');
            Route::post('', [UserController::class, 'store'])->name('users.store');
            Route::prefix('/{user}')->group(function () {
                Route::get('/', [UserController::class, 'show'])->name('users.show');
                Route::post('/', [UserController::class, 'update'])->name('users.update');
                Route::delete('/', [UserController::class, 'destroy'])->name('users.destroy');
            });
        });
    });
});
