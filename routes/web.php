<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PemasController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;

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

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('news', [LandingController::class, 'details'])->name('news');
Route::get('/news_detail/{slug}', [LandingController::class, 'detail'])->name('detail');




Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login')->middleware('guest');
    Route::post('login', 'loginPost')->name('login.post');
    Route::post('logout', 'logout')->name('logout');
    Route::get('register', 'register')->name('register')->middleware('guest');
    Route::post('register', 'registerPost')->name('register.post');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('profile/{id}/update', [DashboardController::class, 'update_profile'])->whereNumber('id')->name('profile.update');
    Route::post('profile/{id}/resetpass', [DashboardController::class, 'updatepassword'])->whereNumber('id')->name('password.update');


    Route::get('pemas', [PemasController::class, 'index'])->name('pemas');
    Route::post('pemas/store', [PemasController::class, 'store'])->name('pemas.store');
});


Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->middleware('guest')->name('forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'main'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'sendResetToken'])->middleware('guest')->name('password.update');

Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');

Route::get('contact', function () {
    return view('tamplate.landingpage.contact');
})->name('contact');

Route::get('communities', function () {
    return view('komunitas.communities');
})->name('communities');

Route::get('pengmases', function () {
    return view('pemas.pengmases');
})->name('pengmases');
