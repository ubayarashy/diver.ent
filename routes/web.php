<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientAreaController;
use App\Http\Controllers\CollaborationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminBriefController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminPortfolioController;

/*
|--------------------------------------------------------------------------
| HOME ROUTE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('home');
})->name('home');

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/check-auth', [AuthController::class, 'check'])->name('check.auth');

/*
|--------------------------------------------------------------------------
| GOOGLE OAUTH
|--------------------------------------------------------------------------
*/

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

/*
|--------------------------------------------------------------------------
| PUBLIC PORTFOLIO ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

/*
|--------------------------------------------------------------------------
| CLIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [ClientAreaController::class, 'index'])->name('dashboard');
    Route::get('/create-project', [CollaborationController::class, 'index'])->name('create-project');
    Route::post('/create-project/store', [CollaborationController::class, 'store'])->name('create-project.store');
    Route::get('/projects', [CollaborationController::class, 'history'])->name('projects');
    Route::get('/payments', [ClientAreaController::class, 'payments'])->name('payments');
    Route::post('/payment/upload/{briefId}', [ClientAreaController::class, 'uploadPaymentProof'])->name('payment.upload');
    Route::get('/profile', [ClientAreaController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [ClientAreaController::class, 'updateProfile'])->name('profile-update');
    Route::get('/notifications', [ClientAreaController::class, 'notifications'])->name('notifications');
});

/*
|--------------------------------------------------------------------------
| TEAM ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('team')->name('team.')->group(function () {
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

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (DENGAN MIDDLEWARE ADMIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // ==================== DASHBOARD ====================
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // ==================== USER MANAGEMENT (TAMBAHKAN INI) ====================
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users/store', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{id}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::put('/users/{id}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{id}', [AdminController::class, 'deleteUser'])->name('users.delete');
        Route::get('/users/{id}', [AdminController::class, 'showUser'])->name('users.show');

        // ==================== BRIEF MANAGEMENT ====================
        Route::get('/briefs', [AdminBriefController::class, 'index'])->name('briefs');
        Route::get('/briefs/{id}', [AdminBriefController::class, 'show'])->name('brief-detail');
        Route::put('/briefs/{id}/status', [AdminBriefController::class, 'updateStatus'])->name('briefs.status');
        Route::delete('/briefs/{id}', [AdminBriefController::class, 'destroy'])->name('briefs.destroy');
        Route::get('/briefs/export/csv', [AdminBriefController::class, 'export'])->name('briefs.export');

        // ==================== PAYMENT MANAGEMENT ====================
        Route::get('/payments', [AdminController::class, 'payments'])->name('payments');
        Route::post('/payments/{id}/verify', [AdminController::class, 'verifyPayment'])->name('payment.verify');
        Route::post('/payments/{id}/reject', [AdminController::class, 'rejectPayment'])->name('payment.reject');
        Route::get('/payments/export/pdf', [AdminController::class, 'exportPaymentsPDF'])->name('payments.export-pdf');

        // ==================== CLIENT MANAGEMENT ====================
        Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
        Route::get('/clients/{id}', [AdminController::class, 'clientDetail'])->name('client-detail');
        Route::delete('/clients/{id}', [AdminController::class, 'deleteClient'])->name('clients.delete');

        // ==================== TEAM MANAGEMENT ====================
        Route::get('/teams', [AdminController::class, 'teams'])->name('teams');
        Route::get('/teams/create', [AdminController::class, 'createTeam'])->name('team-create');
        Route::post('/teams/store', [AdminController::class, 'storeTeam'])->name('team-store');
        Route::get('/teams/{id}/edit', [AdminController::class, 'editTeam'])->name('team-edit');
        Route::put('/teams/{id}', [AdminController::class, 'updateTeam'])->name('team-update');
        Route::delete('/teams/{id}', [AdminController::class, 'deleteTeam'])->name('team-delete');

        // ==================== TASK MANAGEMENT ====================
        Route::get('/tasks', [AdminController::class, 'tasks'])->name('tasks');
        Route::get('/tasks/{id}', [AdminController::class, 'taskDetail'])->name('task.detail');
        Route::post('/tasks/assign', [AdminController::class, 'assignTask'])->name('tasks.assign');
        Route::put('/tasks/{id}/status', [AdminController::class, 'updateTaskStatus'])->name('tasks.status');
        Route::delete('/tasks/{id}', [AdminController::class, 'deleteTask'])->name('tasks.delete');

        // ==================== PORTFOLIO MANAGEMENT ====================
        Route::get('/portfolios', [AdminPortfolioController::class, 'index'])->name('portfolios');
        Route::get('/portfolios/create', [AdminPortfolioController::class, 'create'])->name('portfolio.create');
        Route::post('/portfolios', [AdminPortfolioController::class, 'store'])->name('portfolio.store');
        Route::get('/portfolios/{id}/edit', [AdminPortfolioController::class, 'edit'])->name('portfolio.edit');
        Route::put('/portfolios/{id}', [AdminPortfolioController::class, 'update'])->name('portfolio.update');
        Route::delete('/portfolios/{id}', [AdminPortfolioController::class, 'destroy'])->name('portfolio.destroy');
        Route::post('/portfolios/{id}/toggle', [AdminPortfolioController::class, 'togglePublish'])->name('portfolio.toggle');

        // ==================== ANALYTICS ====================
        Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');

        // ==================== ADMIN PROFILE ====================
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('profile-update');
        Route::post('/profile/upload-photo', [AdminController::class, 'uploadPhoto'])->name('upload-photo');

        // ==================== EXPORT ====================
        Route::get('/briefs/export', [AdminController::class, 'exportBriefs'])->name('briefs.export');
    });

/*
|--------------------------------------------------------------------------
| STATIC PAGES
|--------------------------------------------------------------------------
*/

Route::get('/about', function () {
    return view('home');
})->name('about');

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

/*
|--------------------------------------------------------------------------
| SERVICE DETAIL PAGES
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| SOLUTION PAGES
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| COMPANY PAGES
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| FALLBACK ROUTE
|--------------------------------------------------------------------------
*/

Route::fallback(function () {
    return view('errors.404');
});