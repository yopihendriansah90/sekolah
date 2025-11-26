<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Dedicated Pages
Route::get('/tentang', [PageController::class, 'about'])->name('about');
Route::get('/fasilitas', [PageController::class, 'facilities'])->name('facilities');
Route::get('/guru', [PageController::class, 'teachers'])->name('teachers');
Route::get('/siswa', [PageController::class, 'students'])->name('students');
Route::get('/berita', [PageController::class, 'news'])->name('news');
Route::get('/kegiatan', [PageController::class, 'events'])->name('events');
Route::get('/jurusan', [PageController::class, 'majors'])->name('majors');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');
