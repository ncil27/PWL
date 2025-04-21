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
use App\Http\Controllers\MOController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\JenisSuratController;
use App\Models\ProgramStudi;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    




    Route::middleware(['role:0'])->group(function(){
     
        Route::get('/manage-user', [UserController::class, 'index'])->name('admin.manage-user');
        Route::delete('/admin/manage-user/{id_user}', [UserController::class, 'destroy'])->name('user.destroy');
    
        // Tampilkan halaman edit
        Route::get('/admin/manage-user/{id_user}/edit', [UserController::class, 'edit'])->name('user.edit');
        // Update user
        Route::put('/admin/manage-user/{id_user}', [UserController::class, 'update'])->name('user.update');
        Route::get('/admin/create-user',[AdminController::class,'createUser'])->name('create-user');
        Route::post('/admin/create-user', [UserController::class, 'store'])->name('user.store');
        Route::put('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');

    });

    
    
    Route::post('/mo/upload-surat/{id}', [PengajuanController::class, 'uploadSurat'])->name('mo.uploadSurat');
    Route::get('/manage-pengajuan', [KaprodiController::class, 'managePengajuan'])->name('kaprodi.manage-pengajuan');
    
    Route::get('/final-pengajuan', [MOController::class, 'finalPengajuan'])->name('mo.final-pengajuan');
    Route::get('/mo/detail/{id}', [MOController::class, 'showDetail'])->name('mo.showDetail');

    Route::put('/pengajuan/{id_pengajuan}/update-status', [PengajuanController::class, 'updateStatus'])->name('pengajuan.updateStatus');
    Route::get('/manage-pengajuan', [PengajuanController::class, 'index'])->name('kaprodi.manage-pengajuan');
    Route::post('/mo/upload-file', [MOController::class, 'create'])->name('mo.create');

    Route::post('/pengajuan/store', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::post('/pengajuan/redirect', [PengajuanController::class, 'redirectSurat'])->name('pengajuan.redirect');
    Route::get('/surat/*/*/{id_pengajuan}/back', [PengajuanController::class, 'destroyTemporary'])->name('pengajuan.destroyTemporary');
    Route::get('/lihat-surat/{id}', [PengajuanController::class, 'lihatFile'])->name('surat.lihat');

    Route::get('/surat/skma/create/{id_pengajuan}', [SuratSKMAController::class, 'create'])->name('surat.skma.create');
    Route::post('/surat/skma/store', [SuratSKMAController::class, 'store'])->name('surat.skma.store');    
    Route::get('/surat/skma/edit/{id_pengajuan}', [SuratSKMAController::class, 'edit'])->name('surat.skma.edit');
    Route::put('/surat/skma/update/{id_pengajuan}', [SuratSKMAController::class, 'update'])->name('surat.skma.update');

    Route::get('/surat/sp/create/{id_pengajuan}', [SuratSPController::class, 'create'])->name('surat.sp.create');
    Route::post('/surat/sp/store', [SuratSPController::class, 'store'])->name('surat.sp.store');
    Route::get('/surat/sp/edit/{id_pengajuan}', [SuratSPController::class, 'edit'])->name('surat.sp.edit');
    Route::put('/surat/sp/update/{id_pengajuan}', [SuratSPController::class, 'update'])->name('surat.sp.update');

    Route::get('/surat/slhs/create/{id_pengajuan}', [SuratSLHSController::class, 'create'])->name('surat.slhs.create');
    Route::post('/surat/slhs/store', [SuratSLHSController::class, 'store'])->name('surat.slhs.store');
    Route::get('/surat/slhs/edit/{id_pengajuan}', [SuratSLHSController::class, 'edit'])->name('surat.slhs.edit');
    Route::put('/surat/slhs/update/{id_pengajuan}', [SuratSLHSController::class, 'update'])->name('surat.slhs.update');
    

    Route::post('/surat/skl/store', [SuratSKLController::class, 'store'])->name('surat.skl.store');
    Route::get('/surat/skl/create/{id_pengajuan}', [SuratSKLController::class, 'create'])->name('surat.skl.create');
    Route::get('/surat/skl/edit/{id_pengajuan}', [SuratSKLController::class, 'edit'])->name('surat.skl.edit');
    Route::put('/surat/skl/update/{id_pengajuan}', [SuratSKLController::class, 'update'])->name('surat.skl.update');

    Route::resource('program-studi', ProgramStudiController::class)->middleware('auth');
    Route::get('/manage-data', [ProgramStudiController::class, 'index'])->name('admin.manage-data');
    Route::resource('/program-studi', ProgramStudiController::class)->names([
        'index' => 'program-studi.index',
        'create' => 'program-studi.create',
        'store' => 'program-studi.store',
        'edit' => 'program-studi.edit',
        'update' => 'program-studi.update',
        'destroy' => 'program-studi.destroy',
    ]);
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('jenis-surat', JenisSuratController::class);
    });
    Route::get('/pengajuan/mo', [PengajuanController::class, 'indexMO'])->name('pengajuan.mo');


    Route::get('/mahasiswa/riwayat', [DashboardController::class, 'riwayat'])->name('mahasiswa.riwayat');
    

});
Route::get('/logout', [ProfileController::class, 'logout']);
require __DIR__.'/auth.php';
