<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/eye', function () {
    return view('eyetracking');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/kegiatan', function () {
    return view('kegiatan');
})->middleware(['auth', 'verified'])->name('kegiatan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\PresensiController;

Route::get('/', [PresensiController::class, 'showForm'])->name('welcome');
Route::post('/presensi/submit', [PresensiController::class, 'submitForm'])->name('presensi.submit');

// web.php
Route::post('/kegiatan/store', [PresensiController::class, 'storetype'])->name('kegiatan.store');



require __DIR__.'/auth.php';
