<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\ProductController;


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
    $role = Auth::user()->role;

    if ($role === 'admin') {
        return Inertia::render('AdminDashboard');
    } elseif ($role === 'staff') {
        return Inertia::render('StaffDashboard');
    }

    return Inertia::render('CustomerDashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/menu', function () {
    $role = Auth::user()->role;

    if ($role === 'customer') {
        return Inertia::render('Menu'); // Adjust to your component name
    }

    // Redirect to a different dashboard for admin or staff
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('menu');

Route::get('/contact', function () {
    $role = Auth::user()->role;

    if ($role === 'customer') {
        return Inertia::render('Contact'); // Adjust to your component name
    }

    // Redirect to a different dashboard for admin or staff
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('contact');


Route::get('/cart', function () {
    $role = Auth::user()->role;

    if ($role === 'customer') {
        return Inertia::render('Cart'); // Adjust to your component name
    }

    // Redirect to a different dashboard for admin or staff
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('cart');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
