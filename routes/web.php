<?php

use Illuminate\Support\Facades\Route;
use illuminate\Support\ServiceProvider;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('pages.auth.auth-login');
});

// Route::get('/dashboard', function () {
//     return view('pages.dashboard', ['type_menu' => 'dashboard']);

// });

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard', ['type_menu' => 'home']);
    })->name('home');

    Route::resource('user', UserController::class);
    Route::resource('profil', ProfilController::class);
    Route::resource('product', ProductController::class);


});
