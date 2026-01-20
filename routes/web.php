<?php

// use App\Http\Controllers\Post\IndexController;
// use App\Http\Controllers\Post\TrendController;
// use App\Http\Controllers\Post\CreateController;

// use App\Http\Controllers\RegistrationController;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\LogoutController;


// // Route::prefix('posts')->group(function () {
// //     Route::get('/', Post\IndexController::class)->name('main');
// // });

// Route::get('/', IndexController::class)->name('main');
// Route::get('/trending', TrendController::class)->name('trending');

// Route::get('/about', function () {
//     return view('about');
// });
// Route::get('/auth', function () {
//     return view('auth');
// });

// Route::get('/contact', function () {
//     return view('contact');
// });

// Route::get('/registration', function () {
//     return view('reg');
// });


// Route::get('/user', function () {
//     return view('user');
// })->name('user');

// Route::post('/registration/user', RegistrationController::class)->name('registration');
// Route::post('/user', AuthController::class)->name('auth');
// Route::post('/logout', LogoutController::class)->name('logout');
// Route::post('/create', CreateController::class)->name('create');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trend\IndexController;
use App\Http\Controllers\Trend\TrendController;
use App\Http\Controllers\Trend\CreateController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;




Route::get('/trending', TrendController::class)->name('trending');
Route::post('/create', CreateController::class)->name('create');


Route::get('/', IndexController::class)->name('main');
Route::view('/about', 'about')->name('about');
Route::view('/auth', 'auth')->name('auth.form');
Route::view('/contact', 'contact')->name('contact');
Route::view('/registration', 'reg')->name('registration.form');
Route::view('/user', 'user')->name('user');

// POST-роуты для регистрации, авторизации и выхода
Route::post('/registration/user', RegistrationController::class)->name('registration.submit');
Route::post('/user', AuthController::class)->name('auth.submit');
Route::post('/logout', LogoutController::class)->name('logout');
