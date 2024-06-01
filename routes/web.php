<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderDesignController;
use App\Http\Controllers\OrderPrintController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\UserOrderController;
use App\Http\Middleware\RedirectAdminFromDashboard;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', function () {
    return view('home', ["title"=>"Home"]);
});

Route::get('/division', function () {
    return view('division', ["title"=>"Division"]);
});

Route::get('/relation', function () {
    return view('relation', ["title"=>"Relation"]);
});

Route::get('/publication', function () {
    return view('publication', ["title"=>"Publication"]);
});

Route::get('/service', function () {
    return view('service', ["title"=>"Service"]);
});

// Authentication routes
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', RedirectAdminFromDashboard::class])
    ->name('dashboard');

// Admin route
Route::match(['get', 'post'], '/admin', [LoginController::class, 'admin'])->middleware('admin')->name('admin');

// Routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::post('/orderprint', [OrderPrintController::class, 'store'])->name('orderprint.store');
    Route::post('/orderdesign', [OrderDesignController::class, 'store'])->name('orderdesign.store');

    Route::post('/accept-print/{id}', [UserOrderController::class, 'acceptPrint'])->name('accept-print');
    Route::post('/decline-order/{id}', [UserOrderController::class, 'declineOrder'])->name('decline-order');

    // Routes that require admin access
    Route::middleware(['admin'])->group(function () {
        Route::post('/accept-print-admin/{id}', [AdminPostController::class, 'acceptPrintAdmin'])->name('accept-print-admin');
        Route::post('/accept-payment-admin/{id}', [AdminPostController::class, 'acceptPaymentAdmin'])->name('accept-payment-admin');
        Route::post('/doneprinting/{id}', [AdminPostController::class, 'doneprinting']);
        Route::post('/finishorder/{id}', [AdminPostController::class, 'finishorder']);

        Route::get('/tampilkanorderdesign/ambildatatabeldesign', [AdminPostController::class, 'ambildatatabeldesign'])->name('tampilkanorderdesign.ambildatatabeldesign');
        Route::get('/tampilkanorderprint/ambildatatabelprint', [AdminPostController::class, 'ambildatatabelprint'])->name('tampilkanorderprint.ambildatatabelprint');

        Route::put('/update-design-status/{id_orderdesign}', [AdminPostController::class, 'updateDesignStatus']);
        Route::put('/update-print-status/{id_orderprint}', [AdminPostController::class, 'updatePrintStatus']);
    });
});

// Public search route
Route::get('/search', [AdminPostController::class, 'search']);

// User order routes
Route::get('/order', [UserOrderController::class, 'index']);
Route::get('/user/design', [UserOrderController::class, 'ambildatatabeldesign'])->name('user.design');
Route::get('/user/print', [UserOrderController::class, 'ambildatatabelprint'])->name('user.print');
