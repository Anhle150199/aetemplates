<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\UserController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::prefix('user')->group(function () {
        Route::post('update-profile', [UserController::class, 'updateProfile'])->name('update-profile');
        Route::post('update-password', [UserController::class, 'updatePassword'])->name('update-password');
        Route::post('update-avatar', [UserController::class, 'updateAvatar'])->name('update-avatar');
    });
});
