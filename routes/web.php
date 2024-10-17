<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestBookController;
use App\Http\Controllers\Auth\LoginController;

// Route untuk halaman utama
Route::get('/home', function () {
    return view('home'); // Pastikan ini mengarah ke home.blade.php
})->name('home'); // Memberi nama pada route


// Route untuk tamu
Route::get('/guestbook', [GuestBookController::class, 'index'])->name('guestbook.index');
Route::post('/guestbook', [GuestBookController::class, 'store'])->name('guestbook.store');

// Route untuk login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');

// Route untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute untuk dashboard admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
