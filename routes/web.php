<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\CreatorController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================
// GUEST ROUTES (Semua orang bisa akses)
// ============================================

// Landing Page Utama
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/landing', [HomeController::class, 'index'])->name('landing');

// Explore Projects
Route::get('/explore', [ExploreController::class, 'index'])->name('explore');
Route::get('/explore/category/{category}', [ExploreController::class, 'byCategory'])->name('explore.category');
Route::get('/explore/search', [ExploreController::class, 'search'])->name('explore.search');

// Creator Directory
Route::get('/creators', [CreatorController::class, 'directory'])->name('creators.directory');
Route::get('/creators/{id}/{slug?}', [CreatorController::class, 'profile'])->name('creators.profile');

// Project Detail & Like (POST untuk like)
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.detail');
Route::post('/projects/{slug}/like', [ProjectController::class, 'like'])->name('projects.like')->middleware('auth');
Route::post('/projects/{slug}/bookmark', [ProjectController::class, 'bookmark'])->name('projects.bookmark')->middleware('auth');

// Contact Page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// ============================================
// AUTH ROUTES (Login & Register)
// ============================================

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgot'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'forgot'])->name('password.email');

// ============================================
// USER DASHBOARD ROUTES (Butuh login)
// ============================================

Route::middleware(['auth'])->group(function () {
    
    // User Dashboard
    Route::get('/dashboard', [DashboardController::class, 'userIndex'])->name('dashboard.user');
    Route::get('/dashboard/saved', [DashboardController::class, 'savedProjects'])->name('dashboard.saved');
    Route::get('/dashboard/following', [DashboardController::class, 'followingCreators'])->name('dashboard.following');
    Route::get('/dashboard/history', [DashboardController::class, 'recentlyViewed'])->name('dashboard.history');
    Route::get('/dashboard/settings', [DashboardController::class, 'settings'])->name('dashboard.settings');
    Route::put('/dashboard/settings', [DashboardController::class, 'updateSettings']);
    
    // Follow Creator (POST untuk follow, DELETE untuk unfollow)
    Route::post('/creators/{id}/follow', [CreatorController::class, 'follow'])->name('creators.follow');
    Route::delete('/creators/{id}/unfollow', [CreatorController::class, 'unfollow'])->name('creators.unfollow');
    
    // User Profile Edit (untuk user biasa)
    Route::get('/profile/edit', [DashboardController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('/profile/update', [DashboardController::class, 'updateProfile'])->name('user.profile.update');
    Route::delete('/profile/avatar', [DashboardController::class, 'deleteAvatar'])->name('user.profile.delete-avatar');
});

// ============================================
// CREATOR DASHBOARD ROUTES (Role: creator)
// ============================================

Route::middleware(['auth', 'role:creator'])->prefix('creator')->name('creator.')->group(function () {
    
    // Creator Dashboard
    Route::get('/dashboard', [DashboardController::class, 'creatorIndex'])->name('dashboard');
    
    // Creator Profile Edit
    Route::get('/profile/edit', [DashboardController::class, 'editCreatorProfile'])->name('profile.edit');
    Route::put('/profile/update', [DashboardController::class, 'updateCreatorProfile'])->name('profile.update');
    Route::delete('/profile/avatar', [DashboardController::class, 'deleteCreatorAvatar'])->name('profile.delete-avatar');
    
    // Manage Projects
    Route::get('/projects', [ProjectController::class, 'myProjects'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
    
    // Upload Project (khusus upload gambar/video)
    Route::post('/upload/thumbnail', [ProjectController::class, 'uploadThumbnail'])->name('upload.thumbnail');
    Route::post('/upload/gallery', [ProjectController::class, 'uploadGallery'])->name('upload.gallery');
    Route::delete('/upload/gallery/{id}', [ProjectController::class, 'deleteGallery'])->name('upload.gallery.delete');
    
    // Statistics
    Route::get('/statistics', [DashboardController::class, 'creatorStats'])->name('statistics');
});

// ============================================
// CURATOR DASHBOARD ROUTES (Role: curator/admin)
// ============================================

Route::middleware(['auth', 'role:curator'])->prefix('curator')->name('curator.')->group(function () {
    
    // Curator Dashboard
    Route::get('/dashboard', [DashboardController::class, 'curatorIndex'])->name('dashboard');
    
    // Approve/Reject Projects
    Route::get('/pending-projects', [ProjectController::class, 'pendingProjects'])->name('pending');
    Route::post('/projects/{id}/approve', [ProjectController::class, 'approve'])->name('projects.approve');
    Route::post('/projects/{id}/reject', [ProjectController::class, 'reject'])->name('projects.reject');
    
    // Featured Projects Management
    Route::get('/featured', [ProjectController::class, 'featuredManagement'])->name('featured');
    Route::post('/projects/{id}/feature', [ProjectController::class, 'makeFeatured'])->name('projects.feature');
    Route::delete('/projects/{id}/unfeature', [ProjectController::class, 'unfeature'])->name('projects.unfeature');
    
    // Spam/Plagiarism Control
    Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
    Route::post('/projects/{id}/flag', [ProjectController::class, 'flag'])->name('projects.flag');
    Route::post('/projects/{id}/unflag', [ProjectController::class, 'unflag'])->name('projects.unflag');
    
    // Trending Management
    Route::get('/trending', [DashboardController::class, 'trendingManagement'])->name('trending');
    Route::post('/trending/set', [DashboardController::class, 'setTrending'])->name('trending.set');
});

// ============================================
// TEST ROUTES (Untuk testing)
// ============================================

Route::get('/test-landing', function () {
    return view('landing.index');
});

Route::get('/test-explore', function () {
    return view('explore.index');
});

Route::get('/test-creators', function () {
    return view('creators.directory');
});

Route::get('/test-creator-profile', function () {
    return view('creators.profile');
});

Route::get('/test-project', function () {
    return view('projects.detail');
});

Route::get('/test-login', function () {
    return view('auth.login');
});

Route::get('/test-register', function () {
    return view('auth.register');
});

Route::get('/test-contact', function () {
    return view('contact');
});

Route::get('/test-dashboard-user', function () {
    return view('dashboard.user');
});

Route::get('/test-dashboard-creator', function () {
    return view('dashboard.creator');
});

Route::get('/test-dashboard-curator', function () {
    return view('dashboard.curator');
});

Route::get('/test-upload', function () {
    return view('dashboard.upload');
});