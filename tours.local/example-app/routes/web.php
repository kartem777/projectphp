<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\BookingController;
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
Route::get('/tours/{id}', [TourController::class, 'showuser'])->name('tourdetails');

Route::get('/tours', [TourController::class, 'allinfo'])->name('tours.basic');
Route::get('/image-upload', [ImageController::class, 'showUploadForm'])->name('image.upload.form');
Route::post('/image-upload', [ImageController::class, 'upload'])->name('image.upload');
Route::delete('/image-delete/{id}', [ImageController::class, 'delete'])->name('image.delete');
Route::prefix('admin')->name('admin.')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

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

    Route::get('bookings/index', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
    Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');

    Route::get('/feedbacks/index', [FeedbackController::class, 'indexadmin'])->name('feedbacks.index');
    Route::delete('feedbacks/{feedback}', [FeedbackController::class, 'destroy'])->name('feedbacks.destroy');
});

Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::middleware(['auth', AuthMiddleware::class])->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/my_posts', [PostController::class, 'myPost'])->name('post.myPosts');
    Route::post('/my_posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth', AuthMiddleware::class])->group(function() {
    Route::post('/comments_post', [CommentController::class, 'store_post'])->name('comments_post.store');
    Route::post('/comments_comment', [CommentController::class, 'store_comment'])->name('comments_comment.store');
    Route::post('/comments_tour', [CommentController::class, 'store_tour'])->name('comments_tour.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware(['auth', AuthMiddleware::class])->group(function () {
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');
});

Route::middleware(['auth', AuthMiddleware::class])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('tours/{tour}/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('tours/{tour}/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

Auth::routes();


