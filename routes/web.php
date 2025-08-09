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
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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

    // Product Management Routes
    Route::resource('products', AdminProductController::class);

    // Order Management Routes
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show']);
    Route::patch('orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::patch('orders/{order}/verify-payment', [AdminOrderController::class, 'verifyPayment'])->name('orders.verifyPayment');
    Route::get('orders/report', [AdminOrderController::class, 'report'])->name('orders.report');
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

    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
});

// Comment Routes
Route::middleware('auth')->group(function () {
    Route::post('/multimedia/{multimedia}/comments', [\App\Http\Controllers\frontend\CommentController::class, 'store'])->name('comments.store');
    Route::put('/comments/{comment}', [\App\Http\Controllers\frontend\CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\frontend\CommentController::class, 'destroy'])->name('comments.destroy');

    // Cart Routes
    Route::prefix('cart')->name('frontend.cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::post('/', [CartController::class, 'store'])->name('store');
        Route::patch('/{cart}', [CartController::class, 'update'])->name('update');
        Route::delete('/{cart}', [CartController::class, 'destroy'])->name('destroy');
        Route::delete('/', [CartController::class, 'clear'])->name('clear');
        Route::get('/count', [CartController::class, 'count'])->name('count');
        Route::post('/add', [CartController::class, 'addToCart'])->name('add');
    });

    // Checkout Routes
    Route::prefix('checkout')->name('frontend.checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('index');
        Route::post('/', [CheckoutController::class, 'store'])->name('store');
    });

    // Order Routes
    Route::prefix('orders')->name('frontend.orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::get('/{order}/payment', [CheckoutController::class, 'payment'])->name('payment');
        Route::post('/{order}/payment', [CheckoutController::class, 'processPayment'])->name('processPayment');
        Route::patch('/{order}/cancel', [OrderController::class, 'cancel'])->name('cancel');
        Route::patch('/{order}/confirm-delivery', [OrderController::class, 'confirmDelivery'])->name('confirmDelivery');
        Route::get('/{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');
     });
});

// Public comment routes
Route::get('/multimedia/{multimedia}/comments', [\App\Http\Controllers\frontend\CommentController::class, 'index'])->name('comments.index');
