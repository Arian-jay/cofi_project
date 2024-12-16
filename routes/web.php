<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Models\Product;


Route::get('/auth/google/redirect', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');


Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Dashboard route with role-based redirection
Route::get('/dashboard', function () {
    $role = Auth::user()->role_id;

    if ($role === 1) {
        return Inertia::render('AdminDashboard');
    } elseif ($role === 2) {
        return Inertia::render('StaffDashboard');
    }

    return Inertia::render('CustomerDashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/menu', [ProductController::class, 'index'])->name('menu');
    Route::get('/dash', [ProductController::class, 'display'])->name('dash');
    Route::get('/search', [ProductController::class, 'search'])->name('search');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'getCartsWithProducts'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::put('/cart/{id}', [CartController::class, 'update']);
    Route::post('/transactions', [PaymentController::class, 'submitPayment'])->name('transactions');
    Route::get('/transactions/{id}', [TransactionController::class, 'destroy'])->name('transaction.destroy');
    Route::get('/user/transactions', [TransactionController::class, 'index'])->name('transactions.page');
});

Route::get('/contact', function () {
    $role = Auth::user()->role_id;

    if ($role === 3) {
        return Inertia::render('Contact'); // Adjust to your component name
    }

    // Redirect to a different dashboard for admin or staff
    return Inertia::render('dashboard');
})->name('contact');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
