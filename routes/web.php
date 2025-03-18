<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/try-temp', function () {
    return view('coba-template.try-temp');
});
Route::get('/home', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/manage-user', function () {
    return view('manage-user');
})->middleware(['auth', 'verified'])->name('manage-user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/manage-user', function () {
    $users = User::all(); // Mengambil semua data users
    return view('manage-user', compact('users'));   
})->name('manage-user');

Route::get('/manage-users/{id}/edit', function ($id) {
    $user = User::findOrFail($id);
    return view('edit-user', compact('user'));
})->name('edit-user');

Route::delete('/manage-users/{id}', function ($id) {
    User::destroy($id);
    return redirect()->route('manage-users')->with('success', 'User deleted successfully.');
})->name('delete-user');

require __DIR__.'/auth.php';
