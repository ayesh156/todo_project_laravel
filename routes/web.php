<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('dashboard', [ItemController::class, 'index'])->name('dashboard');
    Route::resource('post', PostController::class);
});




    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');

    // Route::get('/items', function () {
    //     return view('items');
    // })->name('items');

    // Route::post('/items', [ItemController::class, 'store'])->name('items.store');

    // Route::put('/items/{item}', [ItemController::class, 'update'])->name('items.update');

    // Route::get('/gallery', function () {
    //     return view('gallery');
    // })->name('gallery');

    // // Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');

    // Route::post('/gallery', [GalleryController::class, 'upload'])->name('gallery.upload');