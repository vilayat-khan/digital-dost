<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\SitemapController;

/*
|--------------------------------------------------------------------------
| Core
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

/*
|--------------------------------------------------------------------------
| Content
|--------------------------------------------------------------------------
*/

// Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
// Route::get('/author/{author}', [AuthorController::class, 'show'])->name('author.show');
// Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');
// Route::get('/tag/{tag}', [TagController::class, 'show'])->name('tag.show');

Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');
Route::get('/author/{author:slug}', [AuthorController::class, 'show'])->name('author.show');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{tag:slug}', [TagController::class, 'show'])->name('tag.show');

/*
|--------------------------------------------------------------------------
| Newsletter
|--------------------------------------------------------------------------
*/

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->middleware('throttle:5,1')->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [NewsletterController::class, 'unsubscribe'])->middleware('signed')->name('newsletter.unsubscribe');

/*
|--------------------------------------------------------------------------
| Pages
|--------------------------------------------------------------------------
*/

Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->middleware('throttle:5,1')->name('contact.submit');

Route::get('/privacy-policy', [PageController::class, 'privacy'])->name('privacy');
Route::get('/terms-of-use', [PageController::class, 'terms'])->name('terms');
Route::get('/disclaimer', [PageController::class, 'disclaimer'])->name('disclaimer');
Route::get('/cookie-policy', [PageController::class, 'cookies'])->name('cookies');
Route::get('/affiliate-disclosure', [PageController::class, 'affiliate'])->name('affiliate');
Route::get('/editorial-policy', [PageController::class, 'editorial'])->name('editorial');

/*
|--------------------------------------------------------------------------
| Fallback
|--------------------------------------------------------------------------
*/

Route::fallback(function (Request $request) {
    abort(404);
});