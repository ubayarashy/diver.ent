<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('home');
})->name('about');

Route::get('/portfolio', function () {
    return view('portfolio');
})->name('portfolio');

Route::get('/services', function () {
    return view('home');
})->name('services');

Route::get('/contact', function () {
    return view('home');
})->name('contact');
