<?php
use App\Http\Controllers\{
    DashboardController,
    OrderPrintController,
    LoginController,
    RegisterController,
    AdminPostController,
    UserOrderController
};
use App\Http\Middleware\RedirectAdminFromDashboard;
use Illuminate\Support\Facades\Route;

// Public routes
Route::view('/', 'home', ["title" => "Home"]);
Route::view('/division', 'division', ["title" => "Division"]);
Route::view('/relation', 'relation', ["title" => "Relation"]);
Route::view('/publication', 'publication', ["title" => "Publication"]);
Route::view('/service', 'service', ["title" => "Service"]);

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'index']);
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', RedirectAdminFromDashboard::class])
    ->name('dashboard');

// Admin route
Route::match(['get', 'post'], '/admin', [LoginController::class, 'admin'])
    ->middleware('admin')
    ->name('admin');

// Routes that require authentication
Route::middleware('auth')->group(function () {
    Route::post('/orderprint', [OrderPrintController::class, 'store'])->name('orderprint.store');
    Route::post('/accept-print/{id}', [UserOrderController::class, 'acceptPrint'])->name('accept-print');
    Route::post('/decline-order/{id}', [UserOrderController::class, 'declineOrder'])->name('decline-order');

    // Routes that require admin access
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/admin', [AdminPostController::class, 'index'])->name('admin.index');
        Route::post('/accept-print-admin/{id}', [AdminPostController::class, 'acceptPrintAdmin'])->name('accept-print-admin');
        Route::post('/accept-payment-admin/{id}', [AdminPostController::class, 'acceptPaymentAdmin'])->name('accept-payment-admin');
        Route::post('/doneprinting/{id}', [AdminPostController::class, 'doneprinting']);
        Route::post('/finishorder/{id}', [AdminPostController::class, 'finishorder']);
        Route::put('/update-print-status/{id_orderprint}', [AdminPostController::class, 'updatePrintStatus']);
        Route::get('/search', [AdminPostController::class, 'search'])->name('search');
    });    

});

// Public search route
Route::get('/search', [AdminPostController::class, 'search'])->name('search');

// User order routes
Route::middleware('auth')->group(function () {
    Route::get('/order', [UserOrderController::class, 'index'])->name('order.index');
    Route::get('/user/design', [UserOrderController::class, 'ambildatatabeldesign'])->name('user.design');
    Route::get('/user/print', [UserOrderController::class, 'ambildatatabelprint'])->name('user.print');
});
