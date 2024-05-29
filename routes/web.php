<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderDesignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\RedirectAdminFromDashboard;
use App\Http\Controllers\OrderPrintController;

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

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::match(['get', 'post'], '/admin', [LoginController::class, 'admin'])->middleware('admin')->name('admin');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(RedirectAdminFromDashboard::class)
    ->name('dashboard');


Route::post('/orderprint', [OrderPrintController::class, 'store'])->name('orderprint.store')->middleware('auth');
Route::post('/orderdesign', [OrderDesignController::class, 'store'])->name('orderdesign.store')->middleware('auth');