<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemasController;
use App\Http\Controllers\ContactController;
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

Route::get('pengmases', [LandingController::class, 'detailspemas'])->name('pengmases');
Route::get('/pengmases/{slug}', [LandingController::class, 'detailpemas'])->name('detailpemas');




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

    Route::get('userdate', [UserController::class, 'index'])->name('userdate');
    Route::put('userdate/{id}/update', [UserController::class, 'update'])->whereNumber('id')->name('userdate.update');
    Route::delete('userdate/{id}/delete', [UserController::class, 'destroy'])->whereNumber('id')->name('userdate.delete');

    Route::get('informasi', [NewsController::class, 'index'])->name('informasi');
    Route::delete('/informasi/{id}', [NewsController::class, 'delete'])->name('news.delete');
    Route::get('/informasi/{slug}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/informasi/{slug}/update', [NewsController::class, 'update'])->name('news.update');

    Route::post('/reports', [NewsController::class, 'Reportstore'])->name('report.store');
});


Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->middleware('guest')->name('forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'main'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'sendResetToken'])->middleware('guest')->name('password.update');

Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');

Route::controller(ContactController::class)->group(function () {
    Route::get('contact',  'create')->name('contact');
    Route::post('/contact', 'store')->name('kontaks');

    Route::get('/contacts', 'index')->name('contact.index');
    Route::delete('/contacts/{id}', 'destroy')->name('contact.destroy');
});
Route::get('communities', function () {
    return view('komunitas.communities');
})->name('communities');
