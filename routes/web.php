<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminTagController;
use App\Http\Controllers\Admin\AdminActivityLogController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{slug}', [PostController::class, 'byCategory'])->name('posts.category');
Route::get('/tag/{slug}', [PostController::class, 'byTag'])->name('posts.tag');
Route::get('/search', [PostController::class, 'search'])->name('posts.search');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});


// ─── Admin Routes ──────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminPostController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('tags', AdminTagController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('comments', AdminCommentController::class);
    Route::get('logs', [AdminActivityLogController::class, 'index'])->name('logs.index');
    Route::get('contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::delete('contact/{id}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

