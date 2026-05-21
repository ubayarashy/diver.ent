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

Route::get('/service/social-media-management', function () {
    return view('services.social-media-management');
})->name('service.smm');

Route::get('/service/digital-campaign', function () {
    return view('services.digital-campaign');
})->name('service.dc');

Route::get('/service/commercial-photography', function () {
    return view('services.commercial-photography');
})->name('service.cp');

Route::get('/service/foto-produk', function () {
    return view('services.foto-produk');
})->name('service.fp');

Route::get('/service/video-production', function () {
    return view('services.video-production');
})->name('service.vp');
