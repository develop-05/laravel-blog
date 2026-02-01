<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PostController as ControllersPostController;
use App\Http\Controllers\TagController as ControllersTagController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [ControllersPostController::class, 'index'])->name('home');
Route::get('/post/{slug}', [ControllersPostController::class, 'show'])->name('posts.single');
Route::get('/search', [ControllersPostController::class, 'search'])->name('posts.search');
Route::get('/category/{slug}', [ControllersCategoryController::class, 'show'])->name('categories.single');

Route::get('/tag/{slug}', [ControllersTagController::class, 'show'])->name('tags.single');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');


Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'authenticate'])->name('login.authenticate');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.main.index')->middleware('admin');
    Route::get('/posts/basket', [PostController::class, 'basket'])->name('admin.posts.basket');

    Route::get('/posts/basket/{post}/restore', [PostController::class, 'basketRestore'])->name('admin.posts.basket.restore');
    Route::delete('/posts/basket/{post}/destroy', [PostController::class, 'basketRemove'])->name('admin.posts.basket.remove');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/users', AdminUserController::class);

});