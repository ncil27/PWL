<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pengantar-tugas', function () {
    return view('roles.mahasiswa.pengantar-tugas');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user(); // Ambil pengguna yang sedang login

    // Redirect berdasarkan role
    if ($user->role === 'admin') {
        return view('roles.admin.dashboard');
    } elseif ($user->role === 'mo') {
        return view('roles.mo.dashboard');
    } elseif ($user->role === 'kaprodi') {
        return view('roles.kaprodi.dashboard');
    } elseif ($user->role === 'mahasiswa') {
        return view('roles.mahasiswa.dashboard');
    }

    // Default jika tidak memiliki role
    abort(403, 'Unauthorized');
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

Route::post('/pengajuan-surat', [PengajuanController::class, 'store'])->name('pengajuan-surat.store');

require __DIR__.'/auth.php';
