<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Users\UserProfileController;
use App\Http\Controllers\Admin\Users\UserController;
use Laravel\Jetstream\Http\Controllers\Inertia\OtherBrowserSessionsController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['slidebar'=>['dashboards',]]);
    })->name('dashboard');
    Route::prefix('user')->group(function () {
        // All User
        Route::get('all', [UserController::class, 'getAllUser'])->name('get-all-user');
        Route::delete('delete-user', [UserController::class, 'deleteUser'])->name('delete-user');
        // List user request
        Route::get('request', [UserController::class, 'showUserRequest'])->name('user-request');
        Route::put('edit-role', [UserController::class, 'acceptUserRequest'])->name('edit-role'); //Use for edit role user
        Route::delete('delete-request', [UserController::class, 'deleteUserRequest'])->name('delete-request');
        // Profile
        Route::post('update-profile', [UserProfileController::class, 'updateProfile'])->name('update-profile');
        Route::post('update-password', [UserProfileController::class, 'updatePassword'])->name('update-password');
        Route::post('update-avatar', [UserProfileController::class, 'updateAvatar'])->name('update-avatar');
        Route::delete('logout-other-seesion', [UserProfileController::class, 'logoutOtherSession'])->name('logout-other-seesion');
        Route::delete('delete-account', [UserProfileController::class, 'deleteAccount'])->name('delete-account');
    });
});
