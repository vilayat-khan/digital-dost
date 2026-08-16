<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/tag/{slug}', [TagController::class, 'show'])->name('tag.show');
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Route::get('/', function () {
//     return view('welcome');
// });