<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('admin-page', function () {
//     return 'Halaman untuk Admin';
// })->middleware('role:admin')->name('admin.page');

// Route::get('user-page', function () {
//     return 'Halaman untuk User';
// })->middleware('role:user')->name('user.page');

Route::group(['middleware' => ['role:admin']], function () {

    //Manajemen User
    Route::get('user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('user-tambah', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('user-tambah', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('user/{user}/detail', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
    Route::get('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');
    Route::post('user/{user}/ubah', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    Route::post('user/{user}/hapus', [App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
    Route::get('user-import', [App\Http\Controllers\UserController::class, 'showFormImport'])->name('user.showimport');
    Route::post('user-import', [App\Http\Controllers\UserController::class, 'import'])->name('user.import');
    Route::get('user-export', [App\Http\Controllers\UserController::class, 'export'])->name('user.export');

    //Manajemen Kelas
    Route::get('kelas', [App\Http\Controllers\KelasController::class, 'index'])->name('kelas.index');
    Route::get('kelas-tambah', [App\Http\Controllers\KelasController::class, 'create'])->name('kelas.create');
    Route::post('kelas-tambah', [App\Http\Controllers\KelasController::class, 'store'])->name('kelas.store');
    Route::get('kelas/{kelas}/ubah', [App\Http\Controllers\KelasController::class, 'edit'])->name('kelas.edit');
    Route::post('kelas/{kelas}/ubah', [App\Http\Controllers\KelasController::class, 'update'])->name('kelas.update');
    Route::post('kelas/{kelas}/hapus', [App\Http\Controllers\KelasController::class, 'destroy'])->name('kelas.destroy');

    //Manajemen Periode
    Route::get('periode', [App\Http\Controllers\PeriodeController::class, 'index'])->name('periode.index');
    Route::get('periode-tambah', [App\Http\Controllers\PeriodeController::class, 'create'])->name('periode.create');
    Route::post('periode-tambah', [App\Http\Controllers\PeriodeController::class, 'store'])->name('periode.store');
    Route::get('periode/{periode}/ubah', [App\Http\Controllers\PeriodeController::class, 'edit'])->name('periode.edit');
    Route::post('periode/{periode}/ubah', [App\Http\Controllers\PeriodeController::class, 'update'])->name('periode.update');
    Route::post('periode/{periode}/hapus', [App\Http\Controllers\PeriodeController::class, 'destroy'])->name('periode.destroy');

    //Transaksi
    Route::get('transaksi', [App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi-tambah', [App\Http\Controllers\TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('transaksi-tambah', [App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('transaksi/{transaksi}/ubah', [App\Http\Controllers\TransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::post('transaksi/{transaksi}/ubah', [App\Http\Controllers\TransaksiController::class, 'update'])->name('transaksi.update');
    Route::post('transaksi/{transaksi}/hapus', [App\Http\Controllers\TransaksiController::class, 'destroy'])->name('transaksi.destroy');

    //Spp
    Route::get('spp', [App\Http\Controllers\SppController::class, 'index'])->name('spp.index');
});



Route::group(['middleware' => ['role:user']], function () {
    Route::resource('user-page', UserController::class);
});
