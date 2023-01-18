<?php

use App\Http\Livewire\LoginPage;
use App\Http\Livewire\RegisterPage;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\SportPage\RedirectCategory as SportRedirectCategory;
use App\Http\Livewire\SportPage\Home as SportHome;
use App\Http\Livewire\AdminPanel\AddNews as AdminAddNews;
use App\Http\Livewire\SportPage\NewsPage as SportNewsPage;
use App\Http\Livewire\AdminPanel\Category as AdminCategory;
use App\Http\Livewire\AdminPanel\EditPost as AdminEditPost;
use App\Http\Livewire\AdminPanel\NewsList as AdminNewsList;
use App\Http\Livewire\SportPage\Gallery as SportGalleryPage;
use App\Http\Livewire\SportPage\Category as SportCategoryPage;
use App\Http\Livewire\SportPage\SearchPage as SportSearchPage;
use App\Http\Livewire\SportPage\NewsDetail as SportNewsDetailPage;


// Logout Global
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->back();
})->name('global-logout');

// Base Page
Route::domain(config('app.domain'))->middleware('guest')->group(function () {
    Route::get('/register', RegisterPage::class)->name('base-register');
    Route::get('/login', LoginPage::class)->name('base-login');

});

// Sport Page Routing
Route::domain('sport.' . config('app.domain'))->group(function () {
    Route::get('/', SportHome::class)->name('sport-home');
    Route::get('/news', SportNewsPage::class)->name('sport-news');
    Route::get('/gallery', SportGalleryPage::class)->name('sport-gallery');
    Route::get('/category', SportCategoryPage::class)->name('sport-category');
    Route::get('/category/{targetSlug}', SportRedirectCategory::class);
    Route::get('/search', SportSearchPage::class)->name('sport-search');
    Route::get('/post/{target}', SportNewsDetailPage::class);
});

// Admin Pannel Page
Route::domain('admin.' . config('app.domain'))->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/', AdminNewsList::class)->name('admin-news-list');
    Route::get('/category', AdminCategory::class)->name('admin-category');

    Route::prefix('/post')->group(function () {
        Route::get('/add', AdminAddNews::class)->name('admin-add-post');
        Route::get('/edit/{target}', AdminEditPost::class);
    });


});



Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Temp Image Upload
// Route::get('local/temp/{path}', function (string $path){
//     return Storage::disk('local')->download($path);
// })->name('local.temp');
