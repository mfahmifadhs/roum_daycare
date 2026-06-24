<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnakController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PengasuhController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SkriningController;
use App\Http\Controllers\UkerController;
use App\Http\Controllers\UsersController;
use App\Models\Absen;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('absen', [AbsenController::class, 'index'])->name('absen');
Route::post('absen', [AbsenController::class, 'store'])->name('absen.store');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('login', [AuthController::class, 'post'])->name('login.post');

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::get('check-nip', [RegisterController::class, 'checkNip'])->name('check-nip');
Route::post('register-post', [RegisterController::class, 'store'])->name('register.post');

Route::get('getUker/{id}', [UkerController::class, 'getUker'])->name('getUker');

Route::group(['middleware' => 'auth'], function () {
    Route::get('home',      [HomeController::class, 'index'])->name('home');
    Route::get('admin',     [AdminController::class, 'index'])->name('admin');
    Route::get('profile',   [HomeController::class, 'profile'])->name('profile');
    Route::post('profile',  [HomeController::class, 'updateProfile'])->name('profile.update');

    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('anak/detail/{id}',      [AnakController::class, 'detail'])->name('anak.detail');
    Route::get('anak/edit/{id}',        [AnakController::class, 'edit'])->name('anak.edit');
    Route::post('anak/update/{id}',     [AnakController::class, 'update'])->name('anak.update');

    Route::get('users',                 [UsersController::class, 'index'])->name('users');
    Route::get('users/edit/{id}',       [UsersController::class, 'edit'])->name('users.edit');
    Route::post('users/delete/{id}',    [UsersController::class, 'destroy'])->name('users.destroy');
    Route::post('users/update/{id}',    [UsersController::class, 'update'])->name('users.update');

    Route::get('pengasuh',              [PengasuhController::class, 'index'])->name('pengasuh');
    Route::get('pengasuh/edit/{id}',    [PengasuhController::class, 'edit'])->name('pengasuh.edit');
    Route::post('pengasuh/tambah',      [PengasuhController::class, 'store'])->name('pengasuh.post');
    Route::post('pengasuh/delete/{id}', [PengasuhController::class, 'destroy'])->name('pengasuh.destroy');
    Route::post('pengasuh/update/{id}', [PengasuhController::class, 'update'])->name('pengasuh.update');
    
    Route::get('create',    [AnakController::class, 'create'])->name('anak.create');
    Route::get('anak',      [AnakController::class, 'index'])->name('anak');
    Route::get('anak/{id}', [AnakController::class, 'detail'])->name('anak.detail');
    Route::get('anak/skrining/{id}', [AnakController::class, 'skriningDetail']);
    Route::post('anak/store',     [AnakController::class, 'store'])->name('anak.store');

    Route::get('skrining/create', [SkriningController::class, 'create'])->name('skrining.create');

    Route::get('paket/{tipe}/{id}', [PaketController::class, 'store'])->name('paket.store');
    Route::get('reguler/detail/{id}',  [AdminController::class, 'approve'])->name('reguler.detail');
    Route::post('reguler/{aksi}/{id}', [AdminController::class, 'approve'])->name('reguler.approve');

    Route::get('jadwal',                        [JadwalController::class, 'index'])->name('jadwal');
    Route::get('jadwal/detail/{id}',            [JadwalController::class, 'detail'])->name('jadwal.detail');
    Route::get('jadwal/edit/{id}',              [JadwalController::class, 'edit'])->name('jadwal.edit');
    Route::get('jadwal/batal/{id}',             [JadwalController::class, 'cancel'])->name('jadwal.cancel');
    Route::get('jadwal/detailModal/{id}',       [JadwalController::class, 'detailModal'])->name('jadwal.detailModal');
    Route::get('jadwal/daftar/{id}',            [JadwalController::class, 'daftar'])->name('jadwal.daftar');
    Route::get('jadwal/update-peserta/{id}',    [JadwalController::class, 'updatePeserta'])->name('jadwal.updatePeserta');
    Route::post('jadwal/delete/{id}',           [JadwalController::class, 'destroy'])->name('jadwal.destroy');
    Route::post('jadwal',                       [JadwalController::class, 'store'])->name('jadwal.store');
    Route::post('jadwal/update/{id}',           [JadwalController::class, 'update'])->name('jadwal.update');

    Route::get('absen/detail/{id}', [Absen::class, 'detail'])->name('absen.detail');
    // Route::post('absen/store',      [AbsenController::class, 'store'])->name('absen.store');

    Route::get('laporan/edit/{id}',    [LaporanController::class, 'edit'])->name('laporan.edit');
    Route::get('laporan/create/{id}',  [LaporanController::class, 'create'])->name('laporan.create');
    Route::get('laporan/detail/{id}',  [LaporanController::class, 'detail'])->name('laporan.detail');
    Route::post('laporan/store/{id}',  [LaporanController::class, 'store'])->name('laporan.store');
    Route::post('laporan/update/{id}', [LaporanController::class, 'update'])->name('laporan.update');

    Route::get('peserta/detail',  [PesertaController::class, 'detail'])->name('peserta.detail');

    Route::post('kuota/update/{id}',  [SettingController::class, 'updateKuota'])->name('kuota.update');
    

});
