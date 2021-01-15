<?php

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
set_time_limit (120);

Route::get('/', function () {
    return redirect('login');
});

Route::get('/home', 'HomeController@index');

Auth::routes();

// Data Stok
Route::get('jenis_barang', 'JenisbarangController@index')->name('jenis_barang.list');
Route::get('jenis_barang/create', 'JenisbarangController@jenis_barang_create');
Route::post('jenis_barang/store', 'JenisbarangController@jenis_barang_store');
Route::get('jenis_barang/edit/{id}', 'JenisbarangController@jenis_barang_edit');
Route::get('jenis_barang/delete/{id}', 'JenisbarangController@jenis_barang_delete');
Route::post('jenis_barang/update/{id}', 'JenisbarangController@jenis_barang_update');
Route::get('jenis_barang/check_jenis_barang', 'JenisbarangController@check_jenis_barang');

Route::get('stok_barang', 'StokbarangController@index')->name('stok_barang.list');
Route::get('stok_barang/create', 'StokbarangController@stok_barang_create')->name('stok_barang.create');
Route::post('stok_barang/store', 'StokbarangController@stok_barang_store');
Route::get('stok_barang/edit/{id}', 'StokbarangController@stok_barang_edit');
Route::get('stok_barang/delete/{id}', 'StokbarangController@stok_barang_delete');
Route::post('stok_barang/update/{id}', 'StokbarangController@stok_barang_update');
Route::get('stok_barang/check_stok_barang', 'StokbarangController@checkstok_barang');

// Permintaan Barang
Route::get('permintaan', 'PermintaanController@index')->name('permintaan.list');
Route::get('permintaan/create', 'PermintaanController@permintaan_create');
Route::post('permintaan/store', 'PermintaanController@permintaan_store');
Route::get('permintaan/edit/{id}', 'PermintaanController@permintaan_edit')->name('permintaan.edit');
Route::get('permintaan/delete/{id}', 'PermintaanController@permintaan_delete');
Route::post('permintaan/update/{id}', 'PermintaanController@permintaan_update');
Route::get('permintaan/setuju/{id}', 'PermintaanController@permintaan_setuju')->name('permintaan.setuju');
Route::get('permintaan/tidak/{id}', 'PermintaanController@permintaan_tidak')->name('permintaan.tidak_setuju');

// Permintaan Barang jurusan
Route::get('permintaan/jurusan', 'PermintaanJurusanController@index')->name('permintaan.jurusan.list');
Route::get('permintaan/jurusan/create', 'PermintaanJurusanController@permintaan_create')->name('permintaan.jurusan.create');
Route::post('permintaan/jurusan/store', 'PermintaanJurusanController@permintaan_store');
Route::get('permintaan/jurusan/edit/{id}', 'PermintaanJurusanController@permintaan_edit')->name('permintaan.jurusan.edit');
Route::get('permintaan/jurusan/delete/{id}', 'PermintaanJurusanController@permintaan_delete');
Route::post('permintaan/jurusan/update/{id}', 'PermintaanJurusanController@permintaan_update');

Route::get('permintaan/jurusan/cetak_bpp', 'PermintaanJurusanController@permintaan_cetak_bpp')->name('permintaan.jurusan.cetak_bpp');
Route::post('download', 'PermintaanJurusanController@permintaan_download');

Route::get('pengeluaran', 'PengeluaranController@index')->name('pengeluaran.list');
Route::get('pemasukan', 'PemasukanController@index')->name('pemasukan.list');

Route::get('pengguna', 'PenggunaController@index')->name('pengguna.list');
Route::get('pengguna/create', 'PenggunaController@pengguna_create')->name('pengguna.create');
Route::post('pengguna/store', 'PenggunaController@pengguna_store');
Route::get('pengguna/edit/{id}', 'PenggunaController@pengguna_edit')->name('pengguna.edit');
Route::get('pengguna/delete/{id}', 'PenggunaController@pengguna_delete');
Route::post('pengguna/update/{id}', 'PenggunaController@pengguna_update');
Route::get('pengguna/check_pengguna', 'PenggunaController@checkpengguna');

Route::get('role', 'RoleController@index')->name('role.list');
Route::get('role/create', 'RoleController@role_create')->name('role.create');
Route::post('role/store', 'RoleController@role_store');
Route::get('role/edit/{id}', 'RoleController@role_edit')->name('role.edit');
Route::get('role/delete/{id}', 'RoleController@role_delete');
Route::post('role/update/{id}', 'RoleController@role_update');

Route::get('template_pdf', 'PermintaanJurusanController@template_pdf');


