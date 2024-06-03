<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\PemasController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleriesController;
use App\Http\Controllers\CommunitiesController;
use App\Http\Controllers\FileDownloadController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\RegistrasiPemasController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\RegistrasiCommunitiesController;

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
    Route::get('sign-in-google', 'google')->middleware('guest')->name('user.login.google');
    Route::get('auth/google/callback', 'handleProviderCallback')->name('user.google.callback');
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

    Route::delete('/pemasSetting/{id}', [PemasController::class, 'destroy'])->name('pemas.destroy');
    Route::delete('/formPemas/{id}', [PemasController::class, 'destroyForm'])->name('formPemas.destroy');

    Route::get('pemas', [PemasController::class, 'index'])->name('pemas');
    Route::get('pemasSetting', [PemasController::class, 'create'])->name('pemasSetting');

    Route::get('/pemasSetting/{slug}', [PemasController::class, 'edit'])->name('pemas.edit');
    Route::put('/pemasSetting/{slug}/update', [PemasController::class, 'update'])->name('pemas.update');

    Route::get('/formPemas/admin/{slug}', [PemasController::class, 'editFormAdmin'])->name('formPemas.editAdmin');
    Route::put('/formPemas/admin/{slug}/update', [PemasController::class, 'updateFormAdmin'])->name('formPemas.updateAdmin');
    Route::get('/formPemas/{slug}', [PemasController::class, 'editForm'])->name('formPemas.edit');
    Route::put('/formPemas/{slug}/update', [PemasController::class, 'updateForm'])->name('formPemas.update');

    Route::get('/registrasiPemas/{slug}', [RegistrasiPemasController::class, 'index'])->name('registrasiPemas');
    Route::post('/registrasiPemas', [RegistrasiPemasController::class, 'store'])->name('store.registrasiPemas');
    Route::post('/registrasiPemas-add', [RegistrasiPemasController::class, 'storeAuthor'])->name('storeAuthor.registrasiPemas');

    Route::get('/registrasi-pemas/user', [RegistrasiPemasController::class, 'getByUser'])->name('registrasi_pemas.user');
    Route::get('/memberPemas/{slug}', [RegistrasiPemasController::class, 'indexMember'])->name('memberPemas');
    Route::put('/memberPemas/{id}/update', [RegistrasiPemasController::class, 'update'])->name('memberPemas.update');
    Route::delete('/memberPemas/{id}', [RegistrasiPemasController::class, 'destroy'])->name('memberPemas.delete');
    Route::delete('/registrasi-pemas/{id}', [RegistrasiPemasController::class, 'destroyUser'])->name('registrasi_pemas.delete');



    Route::post('pemas/store', [PemasController::class, 'store'])->name('pemas.store');
    Route::get('requestpemas', [PemasController::class, 'request'])->name('requestpemas');
    Route::post('requestpemas/store', [PemasController::class, 'storeForm'])->name('requestpemas.store');

    Route::get('post-informasi', [NewsController::class, 'post'])->name('post.informasi');

    Route::get('informasi', [NewsController::class, 'index'])->name('informasi');
    Route::delete('/informasi/{id}', [NewsController::class, 'delete'])->name('news.delete');
    Route::get('/informasi/{slug}', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/informasi/{slug}/update', [NewsController::class, 'update'])->name('news.update');

    Route::post('/reports', [NewsController::class, 'Reportstore'])->name('report.store');

    Route::get('galeriAdmin/{slug}', [GalleriesController::class, 'indexAdmin'])->name('galeri.Admin');
    Route::get('galeri/{slug}', [GalleriesController::class, 'index'])->name('galeri.add');
    Route::post('galeri', [GalleriesController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/{id}', [GalleriesController::class, 'delete'])->name('galeri.delete');

    Route::post('/registrasi-communities', [RegistrasiCommunitiesController::class, 'store'])->name('store.regKomunitas');
    Route::get('/registrasi-communities/{slug}', [RegistrasiCommunitiesController::class, 'index'])->name('regKomunitas');
    Route::get('registrasi-communities/{slug}/edit-status', [RegistrasiCommunitiesController::class, 'editStatus'])->name('registrasiCommunities.editStatus');
    Route::put('registrasi-communities/{id}/update-status', [RegistrasiCommunitiesController::class, 'updateStatus'])->name('registrasiCommunities.updateStatus');

    Route::get('komunitas/pengguna', [CommunitiesController::class, 'komunitasPengguna'])->name('komunitas.pengguna');
    Route::get('komunitas/daftar', [CommunitiesController::class, 'daftar'])->name('komunitas.daftar');
    Route::get('komunitas', [CommunitiesController::class, 'index'])->name('komunitas');
    Route::get('community', [CommunitiesController::class, 'create'])->name('communities.create');
    Route::post('community/create', [CommunitiesController::class, 'store'])->name('communities.store');
    Route::get('community/{slug}', [CommunitiesController::class, 'edit'])->name('communities.edit');
    Route::put('/community/{slug}/update', [CommunitiesController::class, 'update'])->name('communities.update');
    Route::delete('/community/{id}', [CommunitiesController::class, 'delete'])->name('communities.delete');

    Route::get('/download/lpj/{slug}', [FileDownloadController::class, 'downloadLpj'])->name('download.lpj');
    Route::get('/download-proposal/{slug}', [FileDownloadController::class, 'downloadProposal'])->name('download.proposal');
});

Route::middleware(['IsAdmin', 'verified'])->group(function () {
    Route::get('menuHome', [LandingController::class, 'menu'])->name('menuHome');
    Route::get('menuHome/{id}', [LandingController::class, 'menuUpdate'])->name('menuHome.edit');
    Route::put('menuHome/{id}/update', [LandingController::class, 'store'])->name('landings.store');

    Route::get('/menuNews/{slug}', [NewsController::class, 'editAdmin'])->name('news.editAdmin');
    Route::put('/menuNews/{slug}/update', [NewsController::class, 'updateAdmin'])->name('news.updateAdmin');
    Route::get('menuNews', [NewsController::class, 'indexAdmin'])->name('menuNews');

    Route::get('menuPemas', [PemasController::class, 'indexAdmin'])->name('menuPemas');
    Route::get('/menuPemas/{slug}', [PemasController::class, 'editAdmin'])->name('pemas.editAdmin');
    Route::put('/menuPemas/{slug}/update', [PemasController::class, 'updateAdmin'])->name('pemas.updateAdmin');

    Route::get('/memberPemas-admin/{slug}', [RegistrasiPemasController::class, 'indexAdmin'])->name('memberPemas.admin');

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
