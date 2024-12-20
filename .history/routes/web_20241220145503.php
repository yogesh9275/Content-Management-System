<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutUsElementController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactController;

// Default home route
Route::get('/', function () {
    if (Auth::check()) {
        // Redirect to /news if the user is logged in
        return redirect()->route('news.index');
    }

    // If not logged in, show the login page
    return redirect()->route('login');
});
// Authentication routes (login, register, reset, etc.)
Auth::routes();

// Protected routes (only accessible to authenticated users)
Route::middleware(['auth'])->group(function () {

    // Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // About Us Elements
    Route::resource('about-us', AboutUsElementController::class);

    // API route for fetching About Us data
    Route::get('/api/about-us', [AboutUsElementController::class, 'response'])->name('api.about-us');

    // Galleries
    Route::resource('galleries', GalleryController::class);

    // API route for fetching Gallery data
    Route::get('/api/galleries', [GalleryController::class, 'response'])->name('api.galleries');

    // News
    Route::resource('news', NewsController::class);

    // API route for fetching News data
    Route::get('/api/news', [NewsController::class, 'response'])->name('api.news');

    // Homepage elements
    Route::resource('homepage', HomePageController::class)->except(['show']);

    // Custom routes for Homepage
    Route::get('homepage/about', [HomePageController::class, 'about'])->name('homepage.about');
    Route::get('homepage/slider', [HomePageController::class, 'slider'])->name('homepage.slider');
    Route::get('homepage/vision', [HomePageController::class, 'vision'])->name('homepage.vision');

    // Settings
    Route::resource('settings', SettingController::class);

    //Contacts
    Route::resource('contacts', ContactController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



use Illuminate\Support\Facades\File;

Route::get('/admin/uploads/gallery/{filename}', function ($filename) {
    $path = base_path('uploads/gallery/' . $filename);

    if (!File::exists($path)) {
        abort(404); // Return 404 if the file does not exist
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return response($file, 200)->header('Content-Type', $type);
});


Route::get('/admin/uploads/gallery/{filename}', function ($filename) {
    $path = base_path('uploads/gallery/' . $filename);

    if (!File::exists($path)) {
        abort(404); // Return 404 if the file does not exist
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    return response($file, 200)->header('Content-Type', $type);
});
