<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});


Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/forgot', function () {
    return view('auth.forgot-password');
});

Route::get('/horizontal-menu', function () {
    $menuItems = json_decode(File::get(storage_path('app/horizontal-menu-items.json')), true);
    return view('layouts.horizontal-menu', compact('menuItems'));
});

