<?php
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\KelasController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/',[SesiController::class,'index'])->name('login');
    Route::post('/',[SesiController::class,'login']);
});

Route::get('/home', function () {
    return redirect('/beranda');
});

Route::middleware(['auth'])->group(function () {

Route::get('/beranda',[AdminController::class,'index'])->name('beranda');

Route::resource('/user', UserController::class)->middleware('userAkses:admin');
Route::resource('/kelas', KelasController::class)->middleware('userAkses:admin');
Route::resource('/siswa', SiswaController::class)->middleware('userAkses:admin');

Route::resource('/presensi', PresensiController::class);

Route::get('/laporan',[PresensiController::class,'laporan'])->name('laporan');

Route::post('/presensi/filter', [PresensiController::class, 'filter'])->name('presensi.filter');
Route::post('/siswa/filterSiswa', [SiswaController::class, 'filterSiswa'])->name('presensi.filterSiswa');



Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
});
