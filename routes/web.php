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
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

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
    return view('roles.admin.manage-user', compact('users'));   
})->name('manage-user');

// Route::get('/manage-users/{id_user}/edit', function ($id_user) {
//     $user = User::findOrFail($id_user);
//     return view('edit-user', compact('user'));
// })->name('edit-user');

// Route::delete('/manage-users/{id_user}', function ($id_user) {
//     User::destroy($id_user);
//     return redirect()->route('manage-users')->with('success', 'User deleted successfully.');
// })->name('delete-user');


Route::delete('/admin/manage-user/{id_user}', [UserController::class, 'destroy'])->name('user.destroy');

// Tampilkan halaman edit
Route::get('/admin/manage-user/{id_user}/edit', [UserController::class, 'edit'])->name('user.edit');
// Update user
Route::put('/admin/manage-user/{id_user}', [UserController::class, 'update'])->name('user.update');
Route::get('/admin/create-user',[AdminController::class,'createUser'])->name('create-user');
Route::post('/admin/create-user', [UserController::class, 'store'])->name('user.store');

Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
Route::post('/pengajuan/redirect', [PengajuanController::class, 'redirectSurat'])->name('pengajuan.redirect');
Route::get('/surat/*/*/{id_pengajuan}/back', [PengajuanController::class, 'destroyTemporary'])->name('pengajuan.destroyTemporary');

// Route::get('/pengajuan/hapus/{id}', [SuratSKMAController::class, 'destroyTemporary'])
//     ->name('pengajuan.destroyTemporary');
// Route::get('/surat/skma/create/{id_pengajuan}/back', [SuratSKMAController::class, 'destroyTemporary'])->name('skma.back');
Route::get('/surat/skma/create/{id_pengajuan}', [SuratSKMAController::class, 'create'])->name('surat.skma.create');
Route::post('/surat/skma/store', [SuratSKMAController::class, 'store'])->name('surat.skma.store');

// Route::get('/surat/sp/create/{id_pengajuan}/back', [SuratSPController::class, 'destroyTemporary'])->name('sp.back');
Route::get('/surat/sp/create/{id_pengajuan}', [SuratSPController::class, 'create'])->name('surat.sp.create');
Route::post('/surat/sp/store', [SuratSPController::class, 'store'])->name('surat.sp.store');

Route::get('/surat/skl/create', [SuratSKLController::class, 'create'])->name('surat.skl.create');
Route::get('/surat/slhs/create', [SuratSLHSController::class, 'create'])->name('surat.slhs.create');

























Route::get('/logout', [ProfileController::class, 'logout']);

require __DIR__.'/auth.php';
