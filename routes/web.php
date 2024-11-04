<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminReportController;


Route::get('/home', function () {
    return redirect('/'); // Redirect ke /
})->name('home');

// Route utama untuk halaman home
Route::get('/', function () {
    return view('home');
})->name('home.page');



// Route untuk tamu
Route::get('/guestbook', [GuestBookController::class, 'index'])->name('guestbook.index');
Route::post('/guestbook', [GuestBookController::class, 'store'])->name('guestbook.store');

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

Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports');
Route::post('/admin/reports/export', [AdminReportController::class, 'export'])->name('admin.reports.export');

// Rute untuk mengakses fungsi testExport
Route::get('/test-export', [AdminReportController::class, 'testExport']);


