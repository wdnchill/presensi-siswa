<?php
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [SesiController::class, 'index'])->name('login');
    Route::post('/', [SesiController::class, 'login']);
});

Route::get('/home', function() {
     return redirect('/beranda');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/beranda', [AdminController::class, 'index'])->name('beranda');

    Route::middleware(['userAkses:admin'])->group(function () {
        Route::resource('/user', UserController::class);
        Route::resource('/kelas', KelasController::class);
        Route::resource('/siswa', SiswaController::class);
        Route::resource('/mapel', MapelController::class);
    });

    Route::get('/laporan', [PresensiController::class, 'laporan'])->name('laporan');
    Route::resource('/presensi', PresensiController::class);
    Route::post('import', [ImportController::class, 'import'])->name('import');
    Route::post('/siswa/filterSiswa', [SiswaController::class, 'filterSiswa'])->name('presensi.filterSiswa');
    Route::post('/presensi/filter', [PresensiController::class, 'filter'])->name('presensi.filter');

    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');

});
