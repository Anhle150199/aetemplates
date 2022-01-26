<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\UserProfileController;
use Laravel\Jetstream\Http\Controllers\Inertia\OtherBrowserSessionsController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::prefix('user')->group(function () {
        Route::post('update-profile', [UserProfileController::class, 'updateProfile'])->name('update-profile');
        Route::post('update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');
        Route::post('update-avatar', [UserProfileController::class, 'updateAvatar'])->name('update-avatar');
        Route::delete('logout-other-seesion', [UserProfileController::class, 'logoutOtherSession'])->name('logout-other-seesion');
    });
});
