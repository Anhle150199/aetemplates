<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Admin\Users\UserProfileController;
use App\Http\Controllers\Admin\Posts\TagController;
use App\Http\Controllers\Admin\Posts\CategoryController;
use App\Http\Controllers\Admin\Posts\PostController;
use App\Http\Controllers\Admin\Posts\MediaController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Redis;
use Laravel\Jetstream\Http\Controllers\Inertia\OtherBrowserSessionsController;

Route::get('/', [WebsiteController::class, 'getHome'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::redirect('/admin', '/dashboard');
    Route::get('/dashboard', function () {
        return view('dashboard', ['slidebar' => ['dashboards',]]);
    })->name('dashboard');

    // Posts manage
    Route::prefix('posts')->group(function () {
        Route::post('upload-image', [MediaController::class, 'uploadImange'])->name('upload-image');

        // Posts
        Route::get('/', function () {
            return redirect()->route('all-post');
        });
        Route::get('all', [PostController::class, 'getAllPost'])->name('all-post');
        Route::get('new-post', [PostController::class, 'getNewPost'])->name('new-post');
        Route::post('add-new-post', [PostController::class, 'addNewPost'])->name('add-new-post');
        Route::get('edit-post/{id}', [PostController::class, 'getEditPost'])->name('edit-post');
        Route::post('update-post', [PostController::class, 'updatePost'])->name('update-post');
        Route::put('update-post-type', [PostController::class, 'updatePostType'])->name('update-post-type');
        Route::delete('delete-post', [PostController::class, 'deletePost'])->name('delete-post');

        // Categories
        Route::get('categories', [CategoryController::class, 'showCategory'])->name('show-categories');
        Route::get('get-categories', [CategoryController::class, 'getAllCategories'])->name('get-categories');
        Route::post('add-category', [CategoryController::class, 'addCategory'])->name('add-category');
        Route::put('edit-category', [CategoryController::class, 'editCategory'])->name('edit-category');
        Route::delete('delete-category', [CategoryController::class, 'deleteCategory'])->name('delete-category');

        // Tags
        Route::get('tags', [TagController::class, 'showTag'])->name('show-tags');
        Route::get('get-tags', [TagController::class, 'getAllTags'])->name('get-tags');
        Route::put('add-tag', [TagController::class, 'addTag'])->name('add-tag');
        Route::put('edit-tag', [TagController::class, 'editTag'])->name('edit-tag');
        Route::delete('delete-tag', [TagController::class, 'deleteTag'])->name('delete-tag');
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

    Route::get('/media', [MediaController::class, 'getAllImage'])->name('media');
});
