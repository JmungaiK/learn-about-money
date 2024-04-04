<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ModuleMappingController;
use App\Http\Controllers\ModuleVideoController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Welcome Route
Route::view('/', [WelcomeController::class, 'welcome'])->name('welcome');

// Authenticated Routes with 'verified' middleware
Route::middleware(['auth', 'verified'])->group(function () {
    // Common Routes
    Route::view('profile', 'profile')->name('profile');
    Route::get('/module', [ModuleController::class, 'index'])->name('module.index');


    // User Routes with 'normal' middleware
    Route::middleware(['normal'])->group(function () {
        Route::view('dashboard', 'dashboard')->name('dashboard');
        Route::resource('rating', RatingController::class);
        Route::post('/ratings/{video}', [RatingController::class, 'store'])->name('rating.store');
        Route::resource('comment', CommentController::class)->except('index');
        Route::post('/videos/{video}/comment', [CommentController::class, 'store'])->name('comment.store');
        Route::resource('progress', ProgressController::class)->except(['create', 'store']);
        Route::get('/module', [ModuleController::class, 'index'])->name('module.index');
        Route::get('/module/{module}', [ModuleController::class, 'show'])->name('module.show');
        Route::get('/video/{video}', [VideoController::class, 'show'])->name('video.show');
    });


    // Moderator Routes with 'mod' middleware
    Route::middleware(['mod'])->group(function () {
        Route::resource('video', VideoController::class)->except(['show']);
        Route::get('/videos/create', [VideoController::class, 'create'])->name('video.create');
        Route::resource('modulevideo', ModuleVideoController::class);
        Route::resource('module', ModuleController::class)->except(['index', 'show']);
        Route::get('modulevideo/{moduleVideo}/edit/{module}', [ModuleVideoController::class, 'edit'])->name('modulevideo.edit');
        Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
        Route::view('mod', 'mod')->name('mod');
    });

    // Admin Routes with 'admin' middleware
    Route::middleware(['admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::view('admin', 'admin')->name('admin');
    });

    // Report Generation Route
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/reports/{type}', [ReportController::class, 'generate'])->name('report.generate');
});

// Authentication Routes
require __DIR__ . '/auth.php';
