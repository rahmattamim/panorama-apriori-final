<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ImportTransaksiController;
use App\Http\Controllers\ParameterAprioriController;
use App\Http\Controllers\ProsesAprioriController;
use App\Http\Controllers\HasilAnalisisController;

Route::get('/', function () {
    return view('landing.index');
});

Route::middleware(['auth','verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard',[DashboardController::class,'index'])
        ->name('dashboard');

    // Profil
    Route::get('/profile',[ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class,'destroy'])->name('profile.destroy');

    // User & Owner
    Route::delete('/transaksi/hapus-semua',
        [TransaksiController::class,'destroyAll'])
        ->name('transaksi.destroyAll');
        
    Route::resource('transaksi', TransaksiController::class)
        ->only(['index','create','store','destroy']);


    Route::get('/hasil-analisis',
        [HasilAnalisisController::class,'index'])
        ->name('hasil.index');

    Route::get('/hasil-analisis/pdf',
        [HasilAnalisisController::class,'pdf'])
        ->name('hasil.pdf');
});


// ================= OWNER ONLY =================

Route::middleware(['auth','owner'])->group(function () {

    //Route::delete('/master-barang/hapus-semua',[MasterBarangController::class, 'destroyAll'])
    //    ->name('master-barang.destroyAll');

    Route::resource('master-barang', MasterBarangController::class);

    Route::resource('user', UserController::class);

    Route::get('/transaksi/import',
        [ImportTransaksiController::class,'index'])
        ->name('transaksi.import');

    Route::post('/transaksi/import',
        [ImportTransaksiController::class,'import'])
        ->name('transaksi.import.proses');

    Route::get('/parameter-apriori',
        [ParameterAprioriController::class,'index'])
        ->name('parameter-apriori.index');

    Route::post('/parameter-apriori',
        [ParameterAprioriController::class,'update'])
        ->name('parameter-apriori.update');

    Route::get('/proses-apriori',
        [ProsesAprioriController::class,'index'])
        ->name('apriori.proses');

    Route::post('/proses-apriori',
        [ProsesAprioriController::class,'proses'])
        ->name('apriori.proses.jalankan');

    Route::post('/proses-apriori/semua',
        [ProsesAprioriController::class, 'prosesSemua'])
        ->name('apriori.proses.semua');
        
    //Route::get('/proses-apriori', [AprioriController::class, 'index'])
    //    ->name('apriori.index');

    //Route::post('/proses-apriori', [AprioriController::class, 'proses'])
    //    ->name('apriori.proses');

});

require __DIR__.'/auth.php';