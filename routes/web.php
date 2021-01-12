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

Route::get('agama', 'AgamaController@index')->name('agama.index');
Route::get('agama/create', 'AgamaController@agama_create');
Route::post('agama/store', 'AgamaController@agama_store');
Route::get('agama/edit/{id}', 'AgamaController@agama_edit');
Route::get('agama/delete/{id}', 'AgamaController@agama_delete');
Route::post('agama/update/{id}', 'AgamaController@agama_update');
Route::get('agama/check_agama', 'AgamaController@checkagama');

Route::get('kk', 'KkController@index')->name('kk.index');
Route::get('kk/create', 'KkController@kk_create');
Route::post('kk/store', 'KkController@kk_store');
Route::get('kk/edit/{id}', 'KkController@kk_edit');
Route::get('kk/delete/{id}', 'KkController@kk_delete');
Route::post('kk/update/{id}', 'KkController@kk_update');

Route::get('penduduk', 'PendudukController@index')->name('penduduk.index');
Route::get('penduduk/create', 'PendudukController@penduduk_create');
Route::post('penduduk/store', 'PendudukController@penduduk_store');
Route::get('penduduk/edit/{id}', 'PendudukController@penduduk_edit');
Route::get('penduduk/delete/{id}', 'PendudukController@penduduk_delete');
Route::post('penduduk/update/{id}', 'PendudukController@penduduk_update');

Route::get('angkel/{no_kk}', 'AngkelController@index');
Route::get('individu/{nik}', 'AngkelController@individu');
Route::get('angkel/download/{no_kk}', 'AngkelController@download_kk');

Route::get('desa', 'DesaController@index')->name('desa.index');
Route::get('desa/create', 'DesaController@desa_create');
Route::post('desa/store', 'DesaController@desa_store');
Route::get('desa/edit/{id}', 'DesaController@desa_edit');
Route::get('desa/delete/{id}', 'DesaController@desa_delete');
Route::post('desa/update/{id}', 'DesaController@desa_update');

Route::get('pengguna', 'PenggunaController@index')->name('pengguna.index');
Route::get('pengguna/create', 'PenggunaController@pengguna_create');
Route::post('pengguna/store', 'PenggunaController@pengguna_store');
Route::get('pengguna/edit/{id}', 'PenggunaController@pengguna_edit');
Route::get('pengguna/delete/{id}', 'PenggunaController@pengguna_delete');
Route::post('pengguna/update/{id}', 'PenggunaController@pengguna_update');
Route::get('pengguna/check_pengguna', 'PenggunaController@checkpengguna');

Route::get('role', 'RoleController@index')->name('role.index');
Route::get('role/create', 'RoleController@role_create');
Route::post('role/store', 'RoleController@role_store');
Route::get('role/edit/{id}', 'RoleController@role_edit');
Route::get('role/delete/{id}', 'RoleController@role_delete');
Route::post('role/update/{id}', 'RoleController@role_update');

Route::get('kk_user', 'KkController@kk_user')->name('kk_user.index');
