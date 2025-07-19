<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\ArtikelController as AdminArtikelController;
use App\Http\Controllers\Admin\MultimediaController as AdminMultimediaController;
use App\Http\Controllers\admin\ModulController as AdminModulController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Frontend\ArtikelController;
use App\Http\Controllers\Frontend\MultimediaController;
use App\Http\Controllers\Frontend\ModulController;
use App\Http\Controllers\Frontend\BeritaController;
use App\Http\Controllers\Frontend\HomeController;

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

// Home Routes
Route::get('/', [HomeController::class, 'index'])->name('beranda');
Route::get('/profil', [HomeController::class, 'profil'])->name('profil');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // User Management Routes
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);

    // Kategori Management Routes
    Route::resource('kategori', KategoriController::class);

    // Artikel Management Routes
    Route::resource('artikel', AdminArtikelController::class);

    // Multimedia Management Routes
    Route::resource('multimedia', AdminMultimediaController::class);

    // Modul Management Routes
    Route::resource('modul', AdminModulController::class);

    // Berita Management Routes
    Route::resource('berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);
});

// Frontend Routes
Route::prefix('')->name('frontend.')->group(function () {
    // Artikel Routes
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
    Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');

    // Multimedia Routes
    Route::get('/multimedia', [MultimediaController::class, 'index'])->name('multimedia.index');
    Route::get('/multimedia/{multimedia}', [MultimediaController::class, 'show'])->name('multimedia.show');

    // Modul Routes
    Route::get('/modul', [ModulController::class, 'index'])->name('modul.index');
    Route::get('/modul/{modul}', [ModulController::class, 'show'])->name('modul.show');
    Route::get('/modul/{modul}/download', [ModulController::class, 'download'])->name('modul.download');

    // Berita Routes
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
    Route::get('/berita/{berita}', [BeritaController::class, 'show'])->name('berita.show');
});
