<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlaimController;
use App\Http\Controllers\DamageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\HasilKlaimController;

//autentikasi routes
Auth::routes();

//Halaman home
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Halaman Login
Route::get('/login', [LoginController::class, 'index'])->name('login');

//Aksi login
Route::post('/login', [LoginController::class, 'login']);

// Admin - Aksi cetak pdf
Route::get('/cetakPdf/{id}', [KlaimController::class, 'cetakPdf']);

// Aksi Data Chart
Route::get('/data-chart', [DashboardController::class, 'dataChart']);
// Aksi Data Chart dengan Grouping
Route::post('/data-chart', [DashboardController::class, 'dataChart']);



// Halaman Hak akses Teknisi
Route::middleware(['auth', 'user-access:teknisi'])->group(function () {
    //Dashboard Teknisi
    Route::get('/teknisi', [KlaimController::class, 'indexTeknisiPending'])->name('teknisi.index');
    Route::get('/teknisi-approved', [KlaimController::class, 'indexTeknisiApproved']);
    //halaman tambah klaim
    Route::get('/teknisi/klaim-baru', [KlaimController::class, 'tambahKlaim']);
    //aksi tambah klaim
    Route::post('teknisi/tambah', [KlaimController::class, 'tambah'])->name('teknisi.tambah');
    //Halaman detail klaim
    Route::get('/teknisi/{id}', [KlaimController::class, 'detailKlaimTeknisi']);
    //Aksi cetak pdf
    Route::get('/teknisi/cetakPdf/{id}', [KlaimController::class, 'cetakPdfTeknisi']);
});


// Halaman Hak akses Admin
Route::middleware(['auth', 'user-access:admin'])->group(function () {
    // Admin - Dashboard
    Route::get('/', [DashboardController::class, 'berandaAdmin'])->name('admin.dashboard');
    // Admin - List data Klaim
    Route::get('/listklaim', [KlaimController::class, 'listKlaimAdmin'])->name('admin.listklaim');
    // Admin - Edit Dokumen Klaim
    Route::get('/listklaim/editImage/{id}', [KlaimController::class, 'editImage']);
    // Admin - Detail List Klaim
    Route::get('/listklaim/detail/{id}', [KlaimController::class, 'detailListklaim']);
    // Admin - Aksi Update Data Klaim
    Route::post('/listklaim/update', [KlaimController::class, 'updateKlaim'])->name('klaim.update');
    // Admin - Aksi update Dokumen Klaim
    Route::post('/listklaim/update-img', [KlaimController::class, 'updateImg'])->name('klaim.updateImg');

    // Admin - List Product
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    // Admin - Aksi Tambah Product
    Route::post('produk/tambah', [ProductController::class, 'tambah'])->name('produk.tambah');
    // Admin - Detail produk
    Route::get('/produk/{product}', [ProductController::class, 'detail']);
    // Admin - Aksi update produk
    Route::post('/produk/update', [ProductController::class, 'update'])->name('produk.update');
    // Admin - Halaman edit produk
    Route::get('produk/edit/{product}', [ProductController::class, 'edit']);
    // Admin - Aksi hapus produk
    Route::get('produk/hapus/{id}', [ProductController::class, 'hapus']);

    // Admin - List Kerusakan
    Route::get('/kerusakan', [DamageController::class, 'index'])->name('kerusakan.index');
    // Admin - edit Kerusakan
    Route::get('/kerusakan/edit/{id}', [DamageController::class, 'edit']);
    // Admin - Tambah kerusakan
    Route::post('/kerusakan/tambah', [DamageController::class, 'tambah'])->name('kerusakan.tambah');
    // Admin - update kerusakan
    Route::post('/kerusakan/update', [DamageController::class, 'update'])->name('kerusakan.update');
    // Admin - hapus kerusakan
    Route::get('/kerusakan/hapus/{id}', [DamageController::class, 'hapus']);
    // Admin - Detail kerusakan
    Route::get('/kerusakan/detail/{damage:id}', [DamageController::class, 'detail'])->name('kerusakan.detail');
    // Admin -update di detail kerusakan
    Route::post('/kerusakan/detail/update', [DamageController::class, 'detailUpdate'])->name('kerusakan.detailupdate');
    // Admin - hapus di detail kerusakan
    Route::get('/kerusakan/detail/hapus/{id}', [DamageController::class, 'detailHapus'])->name('kerusakan.detailhapus');

    // Admin - List Distributor
    Route::get('/distributor', [DistributorController::class, 'index'])->name('distributor.index');
    // Admin - Tambah Distributor
    Route::post('/distributor/tambah', [DistributorController::class, 'tambah'])->name('distributor.tambah');
    // Admin - update Distributor
    Route::post('/distributor/update', [DistributorController::class, 'update'])->name('distributor.update');
    // Admin - edit Distributor
    Route::get('/distributor/edit/{id}', [DistributorController::class, 'edit']);
    // Admin - hapus Distributor
    Route::get('/distributor/hapus/{id}', [DistributorController::class, 'hapus']);
    // Admin - Detail List Distributor
    Route::get('/distributor/detail/{distributor:id}', [DistributorController::class, 'detail']);
    // Admin - hapus di detail Distributor
    Route::get('/distributor/detail/hapus/{id}', [DistributorController::class, 'detailHapus'])->name('distributor.detailhapus');
    // Admin - update di detail Distributor
    Route::post('/distributor/detail/update', [DistributorController::class, 'detailUpdate'])->name('distributor.detailupdate');

    // Admin - Halaman List Customer
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    // Admin - Aksi Tambah customer
    Route::post('/customer/tambah', [CustomerController::class, 'tambah'])->name('customer.tambah');
    // Admin - Aksi edit customer
    Route::get('/customer/edit/{id}', [CustomerController::class, 'edit']);
    // Admin - update customer
    Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
    // Admin - hapus customer
    Route::get('/customer/hapus/{id}', [CustomerController::class, 'hapus']);
    // Admin - Detail List Customer
    Route::get('/customer/detail/{customer:id}', [CustomerController::class, 'detail']);
    // Admin - hapus Customer
    Route::get('/customer/detail/hapus/{id}', [CustomerController::class, 'detailHapus'])->name('customer.detailhapus');
    // Admin - update Customer
    Route::post('/customer/detail/update', [CustomerController::class, 'detailUpdate'])->name('customer.detailupdate');

    // Admin - Hasil Klaim
    Route::get('/hasil-klaim', [HasilKlaimController::class, 'index'])->name('hasilKlaim.index');
    // Admin - Tambah Hasil Klaim
    Route::post('hasil-klaim/tambah', [HasilKlaimController::class, 'tambah'])->name('hasilKlaim.tambah');
    // Admin - update Hasil Klaim
    Route::post('/hasil-klaim/update', [HasilKlaimController::class, 'update'])->name('hasilKlaim.update');
    // Admin - Edit Hasil Klaim
    Route::get('hasil-klaim/edit/{claim_results}', [HasilKlaimController::class, 'edit']);

    // Admin - Hapus Hasil Klaim
    Route::get('hasil-klaim/hapus/{id}', [HasilKlaimController::class, 'hapus']);
    // Admin - Detail Hasil Klaim
    Route::get('/hasil-klaim/detail/{id}', [HasilKlaimController::class, 'detail']);
    // Admin - Hapus di Detail Hasil Klaim
    Route::get('/hasil-klaim/detail/hapus/{id}', [HasilKlaimController::class, 'detailHapus'])->name('hasilKlaim.detailhapus');
    // Admin - update di detail Hasil Klaim
    Route::post('/hasil-klaim/detail/update', [HasilKlaimController::class, 'detailUpdate'])->name('hasilKlaim.detailupdate');
});


// Halaman Hak akses Manager
Route::middleware(['auth', 'user-access:manager'])->group(function () {
    // Manager - Dashboard
    Route::get('/manager', [DashboardController::class, 'berandaManager'])->name('manager.dashboard');
    // Manager - List ToApprove
    Route::get('/manager/to-approve', [KlaimController::class, 'toApprove'])->name('to-approve.list');
    //Manager - Detail ToApprove
    Route::get('/manager/to-approve/{id}', [KlaimController::class, 'detailToApprove']);
    //Manager - Update detail ToApprove
    Route::post('/manager/to-approve/update', [KlaimController::class, 'updateToApprove'])->name('toApprove.Update');
    // Manager - List Klaim
    Route::get('/manager/listklaim', [KlaimController::class, 'listklaimManager'])->name('manager.listklaim');
    // Manager - Detail List Klaim
    Route::get('/manager/listklaim/detail/{id}', [KlaimController::class, 'detailKlaimManager']);
});
