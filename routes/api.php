<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KontenController;
use App\Http\Controllers\MidtransController;


Route::post('midtrans/callback', [MidtransController::class, 'callback'])->name('midtrans.callback');
Route::post('login', [LoginController::class, 'loginPost'])->name('api.login');
Route::post('register', [LoginController::class, 'registerUp'])->name('api.register');
Route::get('film', [KontenController::class, 'film'])->name('api.film');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('api.logout');
    Route::get('film/create', [KontenController::class, 'filmcreate'])->name('api.film.create');
    Route::post('film/store', [KontenController::class, 'filmPost'])->name('api.film.store');
    Route::get('film/edit/{id}', [KontenController::class, 'filmEdit'])->name('api.film.edit');
    Route::put('film/update/{id}', [KontenController::class, 'edit'])->name('api.film.update');
    Route::delete('film/delete/{id}', [KontenController::class, 'hapus'])->name('api.film.delete');

    Route::get('bioskop/create', [KontenController::class, 'create_bioskop'])->name('api.bioskop.create');
    Route::post('bioskop/store', [KontenController::class, 'bioskopPost'])->name('api.bioskop.store');
    Route::get('bioskop/edit/{id}', [KontenController::class, 'bioskopEdit'])->name('api.bioskop.edit');
    Route::put('bioskop/update/{id}', [KontenController::class, 'bioskopEP'])->name('api.bioskop.update');
    Route::delete('bioskop/delete/{id}', [KontenController::class, 'hapusBioskop'])->name('api.bioskop.delete');

    Route::get('berita/create', [KontenController::class, 'beritaCreate'])->name('api.berita.create');
    Route::post('berita/store', [KontenController::class, 'beritaUp'])->name('api.berita.store');
    Route::get('berita/edit/{id}', [KontenController::class, 'beritaEdit'])->name('api.berita.edit');
    Route::put('berita/update/{id}', [KontenController::class, 'beritaEP'])->name('api.berita.update');
    Route::delete('berita/delete/{id}', [KontenController::class, 'beritaHapus'])->name('api.berita.delete');

    Route::get('tentang/create', [KontenController::class, 'tentangCreate'])->name('api.tentang.create');
    Route::post('tentang/store', [KontenController::class, 'tentangUp'])->name('api.tentang.store');
    Route::delete('tentang/delete/{id}', [KontenController::class, 'tentangHapus'])->name('api.tentang.delete');

    Route::get('gallery/create', [KontenController::class, 'galleryCreate'])->name('api.gallery.create');
    Route::post('gallery/store', [KontenController::class, 'galleryUp'])->name('api.gallery.store');
    Route::delete('gallery/delete/{id}', [KontenController::class, 'galleryHapus'])->name('api.gallery.delete');
});




Route::get('bioskop', [KontenController::class, 'bioskop'])->name('api.bioskop');
Route::get('berita', [KontenController::class, 'berita'])->name('api.berita');
Route::get('tentang', [KontenController::class, 'tentang'])->name('api.tentang');
Route::get('gallery', [KontenController::class, 'gallery'])->name('api.gallery');

