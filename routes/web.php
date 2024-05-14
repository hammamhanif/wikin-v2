<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PemasController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\CommunitiesController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('communities', [LandingController::class, 'detailscommunities'])->name('communities');
Route::get('/communities/{slug}', [LandingController::class, 'detailcommunity'])->name('detailcommunity');
Route::get('/captcha', [AuthController::class], 'getCaptcha')->name('captcha');

Route::get('/galery/{slug}', [GalleriesController::class, 'indexLanding'])->name('galeri');


Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login')->middleware('guest');
    Route::post('login', 'loginPost')->name('login.post');
    Route::post('logout', 'logout')->name('logout');
    Route::get('register', 'register')->name('register')->middleware('guest');
    Route::post('register', 'registerPost')->name('register.post');
});


Route::get('/email/verify', function () {
    return view('auth.processAuth');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('profile/{id}/update', [DashboardController::class, 'update_profile'])->whereNumber('id')->name('profile.update');
    Route::post('profile/{id}/resetpass', [DashboardController::class, 'updatepassword'])->whereNumber('id')->name('password.update');


    Route::get('pemas', [PemasController::class, 'index'])->name('pemas');
    Route::post('pemas/store', [PemasController::class, 'store'])->name('pemas.store');
    Route::get('requestpemas', [PemasController::class, 'request'])->name('requestpemas');
    Route::post('requestpemas/store', [PemasController::class, 'storeForm'])->name('requestpemas.store');

    Route::get('informasi', [NewsController::class, 'index'])->name('informasi');
    Route::delete('/informasi/{id}', [NewsController::class, 'delete'])->name('news.delete');
    Route::get('/informasi/{slug}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/informasi/{slug}/update', [NewsController::class, 'update'])->name('news.update');


    Route::post('/reports', [NewsController::class, 'Reportstore'])->name('report.store');

    Route::get('galeri/{slug}', [GalleriesController::class, 'index'])->name('galeri.add');
    Route::post('galeri', [GalleriesController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/{id}', [GalleriesController::class, 'delete'])->name('galeri.delete');


    Route::get('komunitas', [CommunitiesController::class, 'index'])->name('komunitas');
    Route::get('community', [CommunitiesController::class, 'create'])->name('communities.create');
    Route::post('community/create', [CommunitiesController::class, 'store'])->name('communities.store');
    Route::get('community/{slug}', [CommunitiesController::class, 'edit'])->name('communities.edit');
    Route::put('/community/{slug}/update', [CommunitiesController::class, 'update'])->name('communities.update');
    Route::delete('/community/{id}', [CommunitiesController::class, 'delete'])->name('communities.delete');
});

Route::middleware(['IsAdmin', 'verified'])->group(function () {
    Route::get('/menuNews/{slug}', [NewsController::class, 'editAdmin'])->name('news.editAdmin');
    Route::put('/menuNews/{slug}/update', [NewsController::class, 'updateAdmin'])->name('news.updateAdmin');
    Route::get('menuNews', [NewsController::class, 'indexAdmin'])->name('menuNews');

    Route::get('menuPemas', [PemasController::class, 'indexAdmin'])->name('menuPemas');
    Route::get('/menuPemas/{slug}', [PemasController::class, 'editAdmin'])->name('pemas.editAdmin');
    Route::put('/menuPemas/{slug}/update', [PemasController::class, 'updateAdmin'])->name('pemas.updateAdmin');

    Route::get('menuCommunity', [CommunitiesController::class, 'indexAdmin'])->name('menuCommunity');
    Route::get('menuCommunity/{slug}', [CommunitiesController::class, 'editAdmin'])->name('communities.editAdmin');
    Route::put('/menuCommunity/{slug}/update', [CommunitiesController::class, 'updateAdmin'])->name('communities.updateAdmin');

    Route::get('userdate', [UserController::class, 'index'])->name('userdate');
    Route::put('userdate/{id}/update', [UserController::class, 'update'])->whereNumber('id')->name('userdate.update');
    Route::delete('userdate/{id}/delete', [UserController::class, 'destroy'])->whereNumber('id')->name('userdate.delete');
});
Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->middleware('guest')->name('forgot');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'main'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'sendResetToken'])->middleware('guest')->name('password.update');

Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');

Route::controller(ContactController::class)->group(function () {
    Route::get('contact',  'create')->name('contact');
    Route::post('/contact', 'store')->name('kontaks');

    Route::get('/contacts', 'index')->name('contacts');
    Route::delete('/contacts/{id}', 'destroy')->name('contact.destroy');
});
