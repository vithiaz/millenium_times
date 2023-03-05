<?php

use App\Http\Livewire\LoginPage;
use App\Http\Livewire\WelcomePage;

use App\Http\Livewire\RegisterPage;
use App\Http\Livewire\UserSettings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\HistoryPage\NewsDetail as HistoryNewsDetailPage;
use App\Http\Livewire\EnvPage\Home as EnvHome;
use App\Http\Livewire\SportPage\Home as SportHome;
use App\Http\Controllers\Socialite\GoogleController;
use App\Http\Livewire\EnvPage\Category as EnvCategory;
use App\Http\Livewire\EnvPage\NewsPage as EnvNewsPage;
use App\Http\Livewire\HistoryPage\Home as HistoryHome;
use App\Http\Livewire\EnvPage\Gallery as EnvGalleryPage;
use App\Http\Livewire\AdminPanel\AddNews as AdminAddNews;
use App\Http\Livewire\EnvPage\SearchPage as EnvSearchPage;
use App\Http\Livewire\SportPage\NewsPage as SportNewsPage;
use App\Http\Livewire\AdminPanel\Category as AdminCategory;
use App\Http\Livewire\AdminPanel\EditPost as AdminEditPost;
use App\Http\Livewire\AdminPanel\NewsList as AdminNewsList;
use App\Http\Livewire\SportPage\Gallery as SportGalleryPage;
use App\Http\Livewire\AdminPanel\EnvConfig as AdminEnvConfig;
use App\Http\Livewire\EnvPage\NewsDetail as EnvNewsDetailPage;
use App\Http\Livewire\HistoryPage\Category as HistoryCategory;
use App\Http\Livewire\HistoryPage\NewsPage as HistoryNewsPage;
use App\Http\Livewire\SportPage\Category as SportCategoryPage;
use App\Http\Livewire\SportPage\SearchPage as SportSearchPage;
use App\Http\Livewire\HistoryPage\Gallery as HistoryGalleryPage;
use App\Http\Livewire\AdminPanel\SportConfig as AdminSportConfig;
use App\Http\Livewire\HistoryPage\SearchPage as HistorySearchPage;
use App\Http\Livewire\SportPage\NewsDetail as SportNewsDetailPage;
use App\Http\Livewire\AdminPanel\HistoryConfig as AdminHistoryConfig;
use App\Http\Livewire\EnvPage\RedirectCategory as EnvRedirectCategory;
use App\Http\Livewire\SportPage\RedirectCategory as SportRedirectCategory;
use App\Http\Livewire\HistoryPage\RedirectCategory as HistoryRedirectCategory;


// Logout Global
Route::get('/logout', function () {
    Auth::logout();
    return redirect()->back();
})->name('global-logout');

// Base Page
Route::domain(config('app.domain'))->group(function () {
    Route::get('/', WelcomePage::class)->name('welcome-page');

    Route::middleware('guest')->group(function () {
        Route::get('/register', RegisterPage::class)->name('base-register');
        Route::get('/login', LoginPage::class)->name('base-login');

        Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google-redirect');
        Route::get('/auth/google/callback', [GoogleController::class, 'callback']);
    });
    
    Route::middleware('auth')->group(function () {
        Route::get('/user-settings', UserSettings::class)->name('user-settings');
    });

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

// Environment Page Routing
Route::domain('environment.' . config('app.domain'))->group(function () {
    Route::get('/', EnvHome::class)->name('env-home');
    Route::get('/news', EnvNewsPage::class)->name('env-news');
    Route::get('/gallery', EnvGalleryPage::class)->name('env-gallery');
    Route::get('/category', EnvCategory::class)->name('env-category');
    Route::get('/category/{targetSlug}', EnvRedirectCategory::class);
    Route::get('/search', EnvSearchPage::class)->name('env-search');
    Route::get('/post/{target}', EnvNewsDetailPage::class);
});

// History Page Routing
Route::domain('history.' . config('app.domain'))->group(function () {
    Route::get('/', HistoryHome::class)->name('history-home');
    Route::get('/news', HistoryNewsPage::class)->name('history-news');
    Route::get('/gallery', HistoryGalleryPage::class)->name('history-gallery');
    Route::get('/category', HistoryCategory::class)->name('history-category');
    Route::get('/category/{targetSlug}', HistoryRedirectCategory::class);
    Route::get('/search', HistorySearchPage::class)->name('history-search');
    Route::get('/post/{target}', HistoryNewsDetailPage::class);
});

// Admin Pannel Page    
Route::domain('admin.' . config('app.domain'))->middleware(['auth','isAdmin'])->group(function () {
    Route::get('/', AdminNewsList::class)->name('admin-news-list');
    Route::get('/category', AdminCategory::class)->name('admin-category');

    Route::prefix('/post')->group(function () {
        Route::get('/add', AdminAddNews::class)->name('admin-add-post');
        Route::get('/edit/{target}', AdminEditPost::class);
    });

    Route::prefix('/view-settings')->group(function () {
        Route::get('/sport', AdminSportConfig::class)->name('sport-page-config');
        Route::get('/environment', AdminEnvConfig::class)->name('env-page-config');
        Route::get('/history', AdminHistoryConfig::class)->name('history-page-config');
    });
});

