<?php

use App\Http\Controllers\Admin\AspirationController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Student\AspirationController as StudentAspirationController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::resource('kategori', CategoryController::class);
    Route::resource('siswa', StudentController::class);
    Route::get('kelola-pengaduan', [AspirationController::class, 'index'])->name('aspirasi.index');
    Route::get('kelola-pengaduan/detail/{id}', [AspirationController::class, 'show'])->name('aspirasi.show');
    Route::post('kelola-pengaduan/detail/{id}/feedback', [AspirationController::class, 'storeFeedback'])
    ->name('aspirasi.feedback');
});

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('beranda', [StudentDashboardController::class, 'index']);
    Route::resource('aspirasi', StudentAspirationController::class);
    Route::get('laporan/detail/{id}', [StudentAspirationController::class, 'show'])->name('aspirasi.show');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'show']);
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
