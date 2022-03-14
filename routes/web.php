<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\UserProfileController;
use App\Http\Controllers\Admin\Posts\TagController;
use App\Http\Controllers\Admin\Posts\CategoryController;
use App\Http\Controllers\Admin\Posts\PostController;
use Illuminate\Support\Facades\Redis;
use Laravel\Jetstream\Http\Controllers\Inertia\OtherBrowserSessionsController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard', ['slidebar' => ['dashboards',]]);
    })->name('dashboard');

    // Posts manage
    Route::prefix('posts')->group(function ()
    {
        // Posts
        Route::get('new-post',[PostController::class,'getDetailPost'])->name('new-post');

        // Categories
        Route::get('categories',[CategoryController::class,'showCategory'])->name('show-categories');
        Route::get('get-categories',[CategoryController::class,'getAllCategories'])->name('get-categories');
        Route::post('add-category',[CategoryController::class,'addCategory'])->name('add-category');
        Route::put('edit-category',[CategoryController::class,'editCategory'])->name('edit-category');
        Route::delete('delete-category',[CategoryController::class,'deleteCategory'])->name('delete-category');

        // Tags
        Route::get('tags',[TagController::class,'showTag'])->name('show-tags');
        Route::get('get-tags',[TagController::class,'getAllTags'])->name('get-tags');
        Route::put('add-tag',[TagController::class,'addTag'])->name('add-tag');
        Route::put('edit-tag',[TagController::class,'editTag'])->name('edit-tag');
        Route::delete('delete-tag',[TagController::class,'deleteTag'])->name('delete-tag');
    });
    //Users manage
    Route::prefix('user')->group(function () {
        // All User
        Route::get('all', [UserController::class, 'getAllUser'])->name('get-all-user');
        Route::delete('delete-user', [UserController::class, 'deleteUser'])->name('delete-user');
        // New user
        Route::get('new-user', function () {
            return view('users.newUser', ['slidebar' => ['users', 'add-new-user']]);
        })->name('new-user');
        Route::put('add-user', [UserController::class, 'addNewUser'])->name('add-user');
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
