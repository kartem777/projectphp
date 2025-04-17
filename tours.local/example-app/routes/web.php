<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\TagController;
use App\Http\Middleware\AdminMiddleware;
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
Route::get('/tours', [TourController::class, 'allinfo'])->name('tours.basic');
Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/tours/index', [TourController::class, 'allinfoadmin'])->name('tours.index');
    Route::get('/tours/create', [TourController::class, 'create'])->name('tours.create');
    Route::post('/tours', [TourController::class, 'store'])->name('tours.store');
    Route::get('/tours/{id}/edit', [TourController::class, 'edit'])->name('tours.edit');
    Route::put('/tours/{id}', [TourController::class, 'update'])->name('tours.update');
    Route::get('/tours/{id}', [TourController::class, 'show'])->name('tours.show');
    Route::delete('/tours/{id}', [TourController::class, 'destroy'])->name('tours.destroy');

    Route::get('/cities/index', [CityController::class, 'index'])->name('cities.index');
    Route::get('/cities/create', [CityController::class, 'create'])->name('cities.create');
    Route::post('/cities', [CityController::class, 'store'])->name('cities.store');
    Route::get('/cities/{id}/edit', [CityController::class, 'edit'])->name('cities.edit');
    Route::put('/cities/{id}', [CityController::class, 'update'])->name('cities.update');
    Route::get('/cities/{id}', [CityController::class, 'show'])->name('cities.show');
    Route::delete('/cities/{id}', [CityController::class, 'destroy'])->name('cities.destroy');

    Route::get('/countries/index', [CountryController::class, 'index'])->name('countries.index');
    Route::get('/countries/create', [CountryController::class, 'create'])->name('countries.create');
    Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
    Route::get('/countries/{id}/edit', [CountryController::class, 'edit'])->name('countries.edit');
    Route::put('/countries/{id}', [CountryController::class, 'update'])->name('countries.update');
    Route::get('/countries/{id}', [CountryController::class, 'show'])->name('countries.show');
    Route::delete('/countries/{id}', [CountryController::class, 'destroy'])->name('countries.destroy');

    Route::get('/tags/index', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{id}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{id}', [TagController::class, 'update'])->name('tags.update');
    Route::get('/tags/{id}', [TagController::class, 'show'])->name('tags.show');
    Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');


});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
