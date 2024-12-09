<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\AboutUsElementController;

Route::get('/about-us', [AboutUsElementController::class, 'index']);
Route::get('/about-us/create', [AboutUsElementController::class, 'create']);
Route::post('/about-us/store', [AboutUsElementController::class, 'store']);
Route::get('/about-us/{id}/edit', [AboutUsElementController::class, 'edit']);
Route::put('/about-us/{id}', [AboutUsElementController::class, 'update']);
Route::delete('/about-us/{id}', [AboutUsElementController::class, 'destroy']);

Route::get('/api/about-us', [AboutUsElementController::class, 'index']);
