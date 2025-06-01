<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth.api')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); })->name('dashboard');
    Route::resource('/mahasiswa', App\Http\Controllers\MahasiswaClientController::class);
    Route::resource('/dosen', App\Http\Controllers\DosenClientController::class);

});

Route::get('/data-kampus', [App\Http\Controllers\KampusController::class, 'index'])->name('data-kampus');
