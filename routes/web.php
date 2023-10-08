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
    return view('login.login');
});

Auth::routes();

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'cekLogin'])->name('cekLogin');

// halaman admin
//user
Route::get('/dashboard', [App\Http\Controllers\Admin\IndexController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('/dashboard/users', [App\Http\Controllers\Admin\User\IndexController::class, 'index'])->middleware('auth')->name('admin.user.index');
Route::get('/dashboard/users/data', [App\Http\Controllers\Admin\User\IndexController::class, 'dataIndex'])->middleware('auth')->name('admin.user.index.data');
Route::get('/dashboard/users/create', [App\Http\Controllers\Admin\User\IndexController::class, 'create'])->middleware('auth')->name('admin.user.create');
Route::post('/dashboard/users/create', [App\Http\Controllers\Admin\User\IndexController::class, 'store'])->middleware('auth')->name('admin.user.store');
Route::get('/dashboard/users/edit/{id}', [App\Http\Controllers\Admin\User\IndexController::class, 'edit'])->middleware('auth')->name('admin.user.edit');

//transaksi barang masuk
Route::get('/dashboard/barang-masuk', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'index'])->middleware('auth')->name('admin.barangmasuk.index');
Route::get('/dashboard/barang-masuk/data', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'dataIndex'])->middleware('auth')->name('admin.barangmasuk.index.data');
Route::get('/dashboard/barang-masuk/create', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'create'])->middleware('auth')->name('admin.barangmasuk.create');
Route::post('/dashboard/barang-masuk/create', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'store'])->middleware('auth')->name('admin.barangmasuk.store');
Route::get('/dashboard/barang-masuk/edit/{id}', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'edit'])->middleware('auth')->name('admin.barangmasuk.edit');


//cargo manifest
Route::get('/dashboard/cargo-manifest', [App\Http\Controllers\Admin\CargoManifest\CargoManifestController::class, 'index'])->middleware('auth')->name('admin.cargomanifest.index');
Route::get('/dashboard/cargo-manifest/data', [App\Http\Controllers\Admin\CargoManifest\CargoManifestController::class, 'dataIndex'])->middleware('auth')->name('admin.cargomanifest.index.data');
Route::get('/dashboard/cargo-manifest/create', [App\Http\Controllers\Admin\CargoManifest\CargoManifestController::class, 'create'])->middleware('auth')->name('admin.cargomanifest.create');
Route::post('/dashboard/cargo-manifest/create', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'store'])->middleware('auth')->name('admin.cargomanifest.store');
// Route::get('/dashboard/barang-masuk/edit/{id}', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'edit'])->middleware('auth')->name('admin.barangmasuk.edit');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/dashboard/cargo-manifest/getdatatransaction/{date}', [App\Http\Controllers\Admin\CargoManifest\CargoManifestController::class, 'getDataTransaction'])->middleware('auth')->name('admin.cargomanifest.datatrasaction');
