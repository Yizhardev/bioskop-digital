<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransaksiController;



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
Route::get('/', [Controller::class, 'index'])->name('index');
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login-check', [LoginController::class, 'loginPost'])->name('loginPost');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register-check', [LoginController::class, 'registerUp'])->name('registerUp');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('berita', [Controller::class, 'berita'])->name('berita');
Route::get('berita/data', [Controller::class, 'beritaData'])->name('berita.data');
Route::get('berita/kategori/{kategori}', [Controller::class, 'beritaByKategori'])->name('berita.kategori');
Route::get('berita/{id}', [Controller::class, 'beritaFull'])->name('beritaFull');
Route::get('film/{id}', [Controller::class, 'filmFull'])->name('filmFull');
Route::get('film', [Controller::class, 'film'])->name('film');
Route::get('tentang/{id}', [Controller::class, 'tentangFull'])->name('tentangFull');
Route::get('bioskop-Full', [Controller::class, 'bioskopFull'])->name('bioskopFull');
Route::get('bioskop', [Controller::class, 'bioskop'])->name('bioskop');
Route::get('bioskop/search', [Controller::class, 'searchBioskop'])->name('bioskop.search');
Route::get('bioskopFull/{id}', [Controller::class, 'bioskopDetail'])->name('bioskop.detail');

Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('register-check', [LoginController::class, 'registerUp'])->name('registerUp');


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,pegawai'])->group(function() {
    Route::get('dashboard', [Controller::class, 'dashboard'])->name('dashboard');
});

Route::prefix('member')->name('member.')->middleware(['auth', 'role:user'])->group(function() {
    Route::get('dashboard', [Controller::class, 'dashboardMember'])->name('dashboard');
    Route::get('transaksi/{id}', [TransaksiController::class, 'create'])->name('transaksiCreate');
    Route::post('transaksi-bayar/{id}', [TransaksiController::class, 'bayar'])->name('filmBayar');
    Route::get('etiket', [TransaksiController::class, 'etiket'])->name('etiket');
    Route::get('transaksi/history', [TransaksiController::class, 'history'])->name('history');
    Route::get('etiket/download/{id}', [TransaksiController::class, 'unduhTiket'])->name('unduhTiket');
    Route::get('history/', [TransaksiController::class, 'history'])->name('history');
    Route::get('/transaksi/konfirmasi/{order_id}', [TransaksiController::class, 'konfirmasi'])->name('transaksi.konfirmasi');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('tentang', [KontenController::class, 'tentang'])->name('tentang');
    Route::get('tentang-create', [KontenController::class, 'tentangCreate'])->name('tentangCreate');
    Route::post('tentang-up', [KontenController::class, 'tentangUp'])->name('tentangUp');
    Route::delete('tentang-hapus/{id}', [KontenController::class, 'tentangHapus'])->name('tentangHapus');

    Route::get('user', [UserController::class, 'user'])->name('user');
    Route::get('user-create', [UserController::class, 'create'])->name('create');
    Route::post('users-post', [UserController::class, 'store'])->name('store');
    Route::delete('user-delete/{id}', [UserController::class, 'hapus'])->name('hapus');
    Route::get('user-update/{id}', [UserController::class, 'editUser'])->name('editUser');
    Route::put('user-update/{id}', [UserController::class, 'edit'])->name('edit');


});


Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin,pegawai'])->group(function () {
    Route::get('film', [KontenController::class, 'film'])->name('film');
    Route::get('film-create', [KontenController::class, 'filmcreate'])->name('filmcreate');
    Route::post('film-up', [KontenController::class, 'filmPost'])->name('filmPost');
    Route::delete('film-hapus/{id}', [KontenController::class, 'hapus'])->name('filmhapus');
    Route::get('film-edit/{id}', [KontenController::class, 'filmEdit'])->name('filmEdit');
    Route::put('film-edit/{id}', [KontenController::class, 'edit'])->name('filmUp');
    Route::get('daftar-bioskop', [KontenController::class, 'bioskop'])->name('bioskop');
    Route::get('create-bioskop', [KontenController::class, 'create_bioskop'])->name('create_bioskop');
    Route::post('bioskop-check', [KontenController::class, 'bioskopPost'])->name('bioskopPost');
    Route::get('bioskop-edit/{id}', [KontenController::class, 'bioskopEdit'])->name('bioskopEdit');
    Route::put('bioskop-edit/{id}', [KontenController::class, 'bioskopEP'])->name('bioskopEP');
    Route::delete('bioskop-hapus/{id}', [KontenController::class, 'hapusBioskop'])->name('hapusBioskop');

    Route::get('berita', [KontenController::class, 'berita'])->name('berita');
    Route::get('berita-create', [KontenController::class, 'beritaCreate'])->name('beritaCreate');
    Route::post('berita-Up', [KontenController::class, 'beritaUp'])->name('beritaUp');
    Route::delete('berita-hapus/{id}', [KontenController::class, 'beritaHapus'])->name('beritaHapus');
    Route::get('berita-edit/{id}', [KontenController::class, 'beritaEdit'])->name('beritaEdit');
    Route::put('berita-edit/{id}', [KontenController::class, 'beritaEP'])->name('beritaEP');

    Route::get('gallery', [KontenController::class, 'gallery'])->name('gallery');
    Route::get('gallery-create', [KontenController::class, 'galleryCreate'])->name('galleryCreate');
    Route::post('gallery-up', [KontenController::class, 'galleryUp'])->name('galleryUp');
    Route::delete('gallery-hapus/{id}', [KontenController::class, 'galleryHapus'])->name('galleryHapus');

});
