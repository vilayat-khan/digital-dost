<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category/{slug}', function ($slug) {
    return "Category page coming next";
})->name('category.show');

Route::get('/post/{slug}', function ($slug) {
    return "Post page coming next";
})->name('post.show');

Route::get('/search', function () {
    return "Search coming next";
})->name('search');

// Route::get('/', function () {
//     return view('welcome');
// });
