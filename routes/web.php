<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesanController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MenuController::class, 'index'])->name('menu.index');
Route::post('/', [MenuController::class, 'tambah'])->name('menu.tambah');
Route::put('/{id}', [MenuController::class, 'ubah'])->name('menu.ubah');
Route::delete('/{id}', [MenuController::class, 'hapus'])->name('menu.hapus');

Route::get('pesan', [PesanController::class, 'index'])->name('menu.index');
Route::post('pesan', [PesanController::class, 'tambah'])->name('pesan.tambah');
Route::delete('pesan/{id}', [PesanController::class, 'hapus'])->name('pesan.hapus');
