<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientAreaController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== HOME ROUTE ====================
Route::get('/', function () {
    return view('home');
})->name('home');

// ==================== AUTH ROUTES (AJAX) ====================
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/check-auth', [AuthController::class, 'check'])->name('check.auth');

// Google OAuth Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// ==================== CLIENT DASHBOARD ROUTES ====================
Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ClientAreaController::class, 'index'])->name('dashboard');
    
    // Create Project (Brief)
    Route::get('/create-project', [CollaborationController::class, 'index'])->name('create-project');
    Route::post('/create-project/store', [CollaborationController::class, 'store'])->name('create-project.store');
    
    // Projects History
    Route::get('/projects', [CollaborationController::class, 'history'])->name('projects');
    
    // Payments
    Route::get('/payments', [ClientAreaController::class, 'payments'])->name('payments');
    
    // Profile
    Route::get('/profile', [ClientAreaController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ClientAreaController::class, 'updateProfile'])->name('profile-update');
});

// ==================== STATIC PAGES ====================
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

Route::get('/blog', function () {
    return view('home');
})->name('blog');

Route::get('/careers', function () {
    return view('home');
})->name('careers');

Route::get('/how-it-works', function () {
    return view('home');
})->name('how-it-works');

// ==================== SERVICE DETAIL PAGES ====================
Route::prefix('service')->name('service.')->group(function () {
    Route::get('/social-media-management', function () {
        return view('services.social-media-management');
    })->name('smm');
    
    Route::get('/digital-campaign', function () {
        return view('services.digital-campaign');
    })->name('dc');
    
    Route::get('/commercial-photography', function () {
        return view('services.commercial-photography');
    })->name('cp');
    
    Route::get('/foto-produk', function () {
        return view('services.foto-produk');
    })->name('fp');
    
    Route::get('/video-production', function () {
        return view('services.video-production');
    })->name('vp');
    
    Route::get('/seo', function () {
        return view('home');
    })->name('seo');
    
    Route::get('/branding', function () {
        return view('home');
    })->name('branding');
    
    Route::get('/website-development', function () {
        return view('home');
    })->name('website');
    
    Route::get('/kol-affiliate', function () {
        return view('home');
    })->name('kol');
    
    Route::get('/logo-design', function () {
        return view('home');
    })->name('logo');
    
    Route::get('/apps-development', function () {
        return view('home');
    })->name('apps');
});

// ==================== SOLUTION PER INDUSTRI ====================
Route::prefix('solution')->name('solution.')->group(function () {
    Route::get('/enterprise', function () {
        return view('home');
    })->name('enterprise');
    
    Route::get('/education', function () {
        return view('home');
    })->name('education');
    
    Route::get('/f-b', function () {
        return view('home');
    })->name('fb');
    
    Route::get('/healthcare', function () {
        return view('home');
    })->name('healthcare');
    
    Route::get('/retail', function () {
        return view('home');
    })->name('retail');
    
    Route::get('/property', function () {
        return view('home');
    })->name('property');
});

// ==================== COMPANY PAGES ====================
Route::prefix('company')->name('company.')->group(function () {
    Route::get('/about', function () {
        return view('home');
    })->name('about');
    
    Route::get('/how-it-works', function () {
        return view('home');
    })->name('how-it-works');
    
    Route::get('/portfolio', function () {
        return view('portfolio');
    })->name('portfolio');
    
    Route::get('/careers', function () {
        return view('home');
    })->name('careers');
    
    Route::get('/blog', function () {
        return view('home');
    })->name('blog');
});

// ==================== FALLBACK ROUTE (404) ====================
Route::fallback(function () {
    return view('errors.404');
});

// Team routes
Route::middleware(['auth', 'role:team'])->prefix('team')->name('team.')->group(function () {
    Route::get('/dashboard', [TeamController::class, 'dashboard'])->name('dashboard');
    Route::get('/tasks', [TeamController::class, 'tasks'])->name('tasks');
    Route::get('/task/{id}', [TeamController::class, 'showTask'])->name('task.detail');
    Route::post('/task/{id}/status', [TeamController::class, 'updateTaskStatus'])->name('task.status');
    Route::post('/task/{id}/progress', [TeamController::class, 'updateProgress'])->name('task.progress');
    Route::post('/task/{id}/upload', [TeamController::class, 'uploadResult'])->name('task.upload');
    Route::get('/calendar', [TeamController::class, 'calendar'])->name('calendar');
    Route::get('/notifications', [TeamController::class, 'notifications'])->name('notifications');
    Route::get('/profile', [TeamController::class, 'profile'])->name('profile');
    Route::post('/profile', [TeamController::class, 'updateProfile'])->name('profile.update');
});