<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/', function () {
    return view('welcome');
});

// Middleware Auth dari Breeze
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/mo/dashboard', [AdminController::class, 'index'])->name('mo.dashboard');
    Route::get('/kaprodi/dashboard', [KaprodiController::class, 'index'])->name('kaprodi.dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redirect user ke dashboard sesuai role setelah login
Route::get('/redirect', function () {
    if (!Auth::check()) {
        return redirect()->route('login'); // Pastikan user sudah login
    }

    $role = Auth::user()->role;

    // Gunakan switch case jika PHP di bawah 8.0
    switch ($role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'kaprodi':
            return redirect()->route('kaprodi.dashboard');
        // case 'mo':
        //     return redirect()->route('mo.dashboard');
        default:
            return redirect()->route('dashboard');
    }
})->middleware('auth')->name('redirect');

Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('register', [RegisteredUserController::class, 'store']);

require __DIR__.'/auth.php';
