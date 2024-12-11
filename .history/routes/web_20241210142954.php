<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\HomeController;
    // Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');


use App\Http\Controllers\AboutUsElementController;

// Route to manage about-us elements with resource controller
Route::resource('about-us', AboutUsElementController::class);

// API route for fetching about-us data
Route::get('/api/about-us', [AboutUsElementController::class, 'response']);

use App\Http\Controllers\GalleryController;

Route::resource('galleries', GalleryController::class);

// API route for fetching about-us data
Route::get('/api/about-us', [GalleryController::class, 'response']);
