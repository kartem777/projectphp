<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TourController::class, 'home']);
Route::get('/documentation', function () {
    return view('welcome');
});
Route::get('/tours', [TourController::class, 'allinfo']);
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    Route::get('/tours/index', [TourController::class, 'allinfoadmin'])->name('tours.index');
    
    Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
    
    Route::post('/tours', [TourController::class, 'store'])->name('tours.store');
    
    Route::get('/tours/{id}/edit', [TourController::class, 'edit'])->name('tours.edit');
    
    Route::put('/tours/{id}', [TourController::class, 'update'])->name('tours.update');
    
    Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');
    
    Route::delete('/tours/{id}', [TourController::class, 'destroy'])->name('tours.destroy');
});

