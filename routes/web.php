<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratSKLController;
use App\Http\Controllers\SuratSKMAController;
use App\Http\Controllers\SuratSLHSController;
use App\Http\Controllers\SuratSPController;

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

// Route::get('/dashboard', function () {
//     $user = Auth::user(); // Ambil pengguna yang sedang login

//     // Redirect berdasarkan role
//     if ($user->id_role === 0) {
//         return view('roles.admin.dashboard');
//     } elseif ($user->id_role === 1) {
//         return view('id_s.kaprodi.dashboard');
//     } elseif ($user->id_role === 2) {
//         return view('roles.mo.dashboard');
//     } elseif ($user->id_role === 3) {
//         return view('roles.mahasiswa.dashboard');
//     }

//     // Default jika tidak memiliki role
//     abort(403, 'Unauthorized');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/manage-user', function () {
    return view('manage-user');
})->middleware(['auth', 'verified'])->name('manage-user');

Route::get('/dashboard/mahasiswa', [DashboardController::class, 'dashboardMahasiswa'])->middleware('auth');

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

Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::post('/pengajuan/redirect', [PengajuanController::class, 'redirectSurat'])->name('pengajuan.redirect');

Route::get('/surat/skma/create', [SuratSKMAController::class, 'create'])->name('surat.skma.create');
Route::get('/surat/sp/create', [SuratSPController::class, 'create'])->name('surat.sp.create');
Route::get('/surat/skl/create', [SuratSKLController::class, 'create'])->name('surat.skl.create');
Route::get('/surat/slhs/create', [SuratSLHSController::class, 'create'])->name('surat.slhs.create');

Route::post('/surat/sp/store', [SuratSPController::class, 'store'])->name('surat.sp.store');
























Route::get('/logout', [ProfileController::class, 'logout']);

require __DIR__.'/auth.php';
