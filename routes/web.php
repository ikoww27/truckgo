<?php

use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\berandaController;
use App\Http\Controllers\layananController;
use App\Http\Controllers\tentangController;
use App\Http\Controllers\TruckController;

// Rute lainnya
Route::get('/', [berandaController::class, 'index']);
Route::get('/layanan', [layananController::class, 'index']);
Route::get('/tentang', [tentangController::class, 'index']);
// Route::get('/api/locations', [layananController::class, 'getLocations']);
Route::get('/api/trucks', [TruckController::class, 'getTruckLocations']);


// // Rute tampilan admintruck
// Route::get('/tampilan', [AdminController::class, 'index'])->name('admin.index');
// Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
// Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
// Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
// Route::get('admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit'); // Menampilkan form edit
// Route::put('admin/{id}', [AdminController::class, 'update'])->name('admin.update'); // Menyimpan perubahan 

// // Rute pencarian
// Route::get('/api/trucks', [TruckController::class, 'searchTrucks']);
