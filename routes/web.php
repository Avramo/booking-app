<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PackageController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{slug}', [PackageController::class, 'show'])->name('packages.show');
Route::get('/packages/{slug}/book', [BookingController::class, 'create'])->name('packages.book');
Route::post('/packages/{slug}/book', [BookingController::class, 'store'])->name('packages.book.store');
