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


// Auth
Route::get('/', 'LoginController@login');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LoginController@logout');

// Dashboard
Route::get('/dashboard', 'PagesController@dashboard');

// Aset
Route::get('/aset', 'AsetController@index');
Route::get('/aset/data/{data}', 'AsetController@data');
Route::get('/aset/create', 'AsetController@create');
Route::post('/aset', 'AsetController@store');
Route::get('/aset/{id}', 'AsetController@show');
Route::get('/aset/{id}/show', 'AsetController@showData');
Route::get('/aset/create/{id}/pengajuan', 'AsetController@createPengajuan');
Route::post('/aset/{id}/indikator', 'AsetController@tambahIndikator');
Route::get('/aset/{id}/edit', 'AsetController@edit');
Route::put('/aset/{id}/edit', 'AsetController@update');
Route::put('/aset/{id}/generate/qrcode', 'AsetController@generateQRcode');
Route::delete('/aset/{id}', 'AsetController@destory');
Route::put('/pengajuan/{id}/penghapusan/', 'AsetController@penghapusan');

// Pegawai
Route::get('/pegawai', 'PegawaiController@index');
Route::get('/pegawai/create', 'PegawaiController@create');
Route::post('/pegawai', 'PegawaiController@store');
Route::get('/pegawai/{id}', 'PegawaiController@show');
Route::get('/pegawai/{id}/edit', 'PegawaiController@edit');
Route::put('/pegawai/{id}/edit', 'PegawaiController@update');

// User
Route::get('/user', 'UserController@index');
Route::get('/user/{id}/profile', 'UserController@edit');
Route::put('/user/{id}/profile', 'UserController@update');
Route::put('/user/{id}/status', 'UserController@ubahStatus');

// Perencanaan
Route::get('/perencanaan', 'PerencanaanController@index');
Route::get('/perencanaan/create', 'PerencanaanController@create');
Route::post('/perencanaan', 'PerencanaanController@store');
Route::get('/perencanaan/{id}', 'PerencanaanController@show');
Route::get('/perencanaan/{id}/edit', 'PerencanaanController@edit');
Route::put('/perencanaan/{id}/edit', 'PerencanaanController@update');
Route::delete('/perencanaan/{id}', 'PerencanaanController@destroy');

// Pengajuan
Route::get('/pengajuan', 'PengajuanController@index');
Route::get('/pengajuan/create', 'PengajuanController@create');
Route::post('/pengajuan', 'PengajuanController@store');
Route::get('/pengajuan/{id}', 'PengajuanController@show');
Route::get('/pengajuan/{id}/edit', 'PengajuanController@edit');
Route::put('/pengajuan/{id}/edit', 'PengajuanController@update');
Route::put('/pengajuan/{id}/ajukan', 'PengajuanController@ajukan_pengajuan');
Route::put('/pengajuan/{id}/persetujuan/{method}', 'PengajuanController@persetujuan');

// Pembelian
Route::get('/pembelian', 'PembelianController@index');
Route::get('/pembelian/create', 'PembelianController@create');
Route::post('/pembelian/{id}/store', 'PembelianController@store');
Route::post('/pembelian/{id}/aset', 'PembelianController@tambahAset');
Route::get('/pembelian/{id}/indikator', 'PembelianController@showAset'); 
Route::get('/pembelian/indikator', 'PembelianController@createIndikator'); 
Route::put('/pembelian/indikator', 'PembelianController@updateIndikator'); 

// Pemeliharaan
Route::get('/pemeliharaan', 'PemeliharaanController@index');
Route::get('/pemeliharaan/create', 'PemeliharaanController@create');
Route::post('/pemeliharaan', 'PemeliharaanController@store');
Route::get('/pemeliharaan/{id}', 'PemeliharaanController@show');
Route::get('/pemeliharaan/{id}/edit', 'PemeliharaanController@edit');
Route::put('/pemeliharaan/{id}/edit', 'PemeliharaanController@update');
Route::delete('/pemeliharaan/{id}', 'PemeliharaanController@destroy');

// Penyusutan
Route::get('/penyusutan', 'PenyusutanController@index');
Route::get('/penyusutan/{id}/create', 'PenyusutanController@create');
Route::post('/penyusutan/{id}/create', 'PenyusutanController@store');
Route::get('/penyusutan/{id}', 'PenyusutanController@show');
Route::get('/penyusutan/{id}/edit', 'PenyusutanController@edit');
Route::put('/penyusutan/{id}/aset', 'PenyusutanController@statusPenyusutan');

// Ruangan
Route::get('/ruangan', 'RuanganController@index');
Route::get('/ruangan/create', 'RuanganController@create');
Route::post('/ruangan', 'RuanganController@store');
Route::get('/ruangan/{id}', 'RuanganController@show');
Route::get('/ruangan/{id}/edit', 'RuanganController@edit');
Route::put('/ruangan/{id}/edit', 'RuanganController@update');
Route::delete('/ruangan/{id}/', 'RuanganController@destroy');

// Laporan
Route::get('/laporan/{method}', 'LaporanController@laporan');
Route::post('/laporan/download/{method}', 'LaporanController@downloadLaporan');

// Monitoring
Route::get('/monitoring', 'MonitoringController@index');
Route::get('/monitoring/{id}', 'MonitoringController@show');

// Data
Route::get('/role/data', 'DataController@dataRole');
Route::get('/stock/data/kode/{kode}', 'DataController@stockByKode');
Route::get('/stock/data/{id}', 'DataController@stockById');



// Route::get('/test', 'PagesController@test');
