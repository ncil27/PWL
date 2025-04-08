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

Route::get('/', function () {
    return view('welcome');
});


    // ->middleware(['auth', 'verified'])

Route::get('/dashboard', function(){
    return view('dashboard');
    })->name('dashboard');
Route::get('/manage-user', function () {
    $users = User::all(); // Mengambil semua data users
    return view('roles.admin.manage-user', compact('users'));   
    })->name('manage-user');
Route::get('/manage-user', function () {
    return view('manage-user');
    })->name('manage-user');

Route::get('/dashboard/mahasiswa', [DashboardController::class, 'dashboardMahasiswa'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    




    Route::middleware(['role:0'])->group(function(){

        Route::delete('/admin/manage-user/{id_user}', [UserController::class, 'destroy'])->name('user.destroy');
    
        // Tampilkan halaman edit
        Route::get('/admin/manage-user/{id_user}/edit', [UserController::class, 'edit'])->name('user.edit');
        // Update user
        Route::put('/admin/manage-user/{id_user}', [UserController::class, 'update'])->name('user.update');
        Route::get('/admin/create-user',[AdminController::class,'createUser'])->name('create-user');
        Route::post('/admin/create-user', [UserController::class, 'store'])->name('user.store');

    });

    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::post('/pengajuan/redirect', [PengajuanController::class, 'redirectSurat'])->name('pengajuan.redirect');
    Route::get('/surat/*/*/{id_pengajuan}/back', [PengajuanController::class, 'destroyTemporary'])->name('pengajuan.destroyTemporary');


    Route::get('/surat/skma/create/{id_pengajuan}', [SuratSKMAController::class, 'create'])->name('surat.skma.create');
    Route::post('/surat/skma/store', [SuratSKMAController::class, 'store'])->name('surat.skma.store');

    Route::get('/surat/sp/create/{id_pengajuan}', [SuratSPController::class, 'create'])->name('surat.sp.create');
    Route::post('/surat/sp/store', [SuratSPController::class, 'store'])->name('surat.sp.store');


    Route::get('/surat/slhs/create/{id_pengajuan}', [SuratSLHSController::class, 'create'])->name('surat.slhs.create');
    Route::post('/surat/slhs/store', [SuratSLHSController::class, 'store'])->name('surat.slhs.store');


    Route::get('/surat/skl/create/{id_pengajuan}', [SuratSKLController::class, 'create'])->name('surat.skl.create');
    Route::post('/surat/skl/store', [SuratSKLController::class, 'store'])->name('surat.skl.store');



});





















Route::get('/logout', [ProfileController::class, 'logout']);

require __DIR__.'/auth.php';
