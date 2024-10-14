<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return View('pages.dashboard', ['type_menu' => 'dashboard']);
});