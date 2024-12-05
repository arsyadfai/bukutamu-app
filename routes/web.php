<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReportController;

Route::get('/home', function () {
    return redirect('/'); // Redirect ke / (halaman utama)
})->name('home');

// Route utama untuk halaman home
Route::get('/', function () {
    return response()
        ->view('home')
        ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', 'Sat, 01 Jan 2000 00:00:00 GMT');
})->name('home.page');

// Route untuk halaman About
Route::get('/about', function () {
    return view('about');
})->name('about');

// Route untuk halaman Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Route untuk tamu, dilindungi middleware auth agar hanya yang sudah login yang bisa mengakses
Route::get('/guestbook', [GuestBookController::class, 'index'])->name('guestbook.index')->middleware('auth');
Route::post('/guestbook', [GuestBookController::class, 'store'])->name('guestbook.store')->middleware('auth');

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); 

// Rute untuk dashboard admin
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');

// Rute untuk laporan admin
Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');
Route::post('/admin/reports/export', [AdminReportController::class, 'export'])->name('admin.reports.export');

// Rute untuk laporan berdasarkan jenis kelamin
Route::get('/admin/reports/male', [AdminController::class, 'showMaleGuests'])->name('admin.male');
Route::get('/admin/reports/female', [AdminController::class, 'showFemaleGuests'])->name('admin.female');

// Rute untuk statistik
Route::get('/admin/statistics', [AdminController::class, 'showMonthlyStatistics'])->name('admin.statistics');

// Rute untuk menampilkan halaman pengaturan
Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin.settings');
// Rute untuk memperbarui username dan kata sandi
Route::post('/admin/settings', [AdminController::class, 'updateSettings'])->name('admin.updateSettings');
