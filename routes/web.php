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
Route::get('/dashboard/users', [App\Http\Controllers\Admin\User\IndexController::class, 'index'])->name('admin.user.index');
Route::get('/dashboard/users/data', [App\Http\Controllers\Admin\User\IndexController::class, 'dataIndex'])->name('admin.user.index.data');
Route::get('/dashboard/users/create', [App\Http\Controllers\Admin\User\IndexController::class, 'create'])->name('admin.user.create');
Route::post('/dashboard/users/create', [App\Http\Controllers\Admin\User\IndexController::class, 'store'])->name('admin.user.store');
Route::get('/dashboard/users/edit/{id}', [App\Http\Controllers\Admin\User\IndexController::class, 'edit'])->name('admin.user.edit');

//transaksi barang masuk
Route::get('/dashboard/barang-masuk', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'index'])->name('admin.barangmasuk.index');
Route::get('/dashboard/barang-masuk/data', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'dataIndex'])->name('admin.barangmasuk.index.data');
Route::get('/dashboard/barang-masuk/create', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'create'])->middleware('auth')->name('admin.barangmasuk.create');
Route::post('/dashboard/barang-masuk/create', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'store'])->name('admin.barangmasuk.store');
Route::get('/dashboard/barang-masuk/edit/{id}', [App\Http\Controllers\Admin\Transaksi\TransaksiController::class, 'edit'])->name('admin.barangmasuk.edit');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
