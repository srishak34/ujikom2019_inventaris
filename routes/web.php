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

Route::get('/', function () {
	return redirect('/loginPage');
});
Route::get('/dashboard', function () {
	return view('users.admin.dashboard.dashboard');
});
Route::post('/search', 'search\searchController@search');
############
### AUTH ###
############
Route::middleware('check_login')->group(function() {
	Route::match(['get', 'post'], '/loginPage', 'loginController@login');
	Route::match(['get', 'post'], '/registerPage', 'registerController@register');
});

Route::get('/logout', 'loginController@logout');

#############
### ADMIN ###
#############

Route::group(['prefix' => '/admin', 'middleware' => 'check_level'], function() {
	Route::get('/', 'i_admin\adminController@index_i');

	Route::group(['prefix' => '/dataInventaris'], function() {
		Route::get('/', 'i_admin\inventaris_adminController\inventarisController@index_data_inv');
		Route::match(['get', 'post'], '/create', 'i_admin\inventaris_adminController\inventarisController@create_data_inv');
		Route::match(['get', 'patch'], '/{id}/update', 'i_admin\inventaris_adminController\inventarisController@update_data_inv');
		Route::delete('/{id}/delete', 'i_admin\inventaris_adminController\inventarisController@destroy_data_inv');
	});

	Route::group(['prefix' => '/dataPetugas'], function() {
		Route::get('/', 'i_admin\data_adminController\dataPetugasController@index_dataPetugas');
		Route::match(['get', 'post'], '/create', 'i_admin\data_adminController\dataPetugasController@create_dataPetugas');
		Route::match(['get', 'patch'], '/{id}/update', 'i_admin\data_adminController\dataPetugasController@update_dataPetugas');
		Route::delete('/{id}/delete', 'i_admin\data_adminController\dataPetugasController@destroy_dataPetugas');
	});

	Route::group(['prefix' => '/dataPegawai'], function() {
		Route::get('/', 'i_admin\data_adminController\dataPegawaiController@index_dataPegawai');
		Route::match(['get', 'post'], '/create', 'i_admin\data_adminController\dataPegawaiController@create_dataPegawai');
		Route::match(['get', 'patch'], '/{id}/update', 'i_admin\data_adminController\dataPegawaiController@update_dataPegawai');
		Route::delete('/{id}/delete', 'i_admin\data_adminController\dataPegawaiController@destroy_dataPegawai');
	});

	Route::group(['prefix' => '/dataJenis'], function() {
		Route::get('/', 'i_admin\data_adminController\dataJenisController@index_dataJenis');
		Route::match(['get', 'post'], '/create', 'i_admin\data_adminController\dataJenisController@create_dataJenis');
		Route::match(['get', 'patch'], '/{id}/update', 'i_admin\data_adminController\dataJenisController@update_dataJenis');
		Route::delete('/{id}/delete', 'i_admin\data_adminController\dataJenisController@destroy_dataJenis');
	});

	Route::group(['prefix' => '/dataRuang'], function() {
		Route::get('/', 'i_admin\data_adminController\dataRuangController@index_dataRuang');
		Route::match(['get', 'post'], '/create', 'i_admin\data_adminController\dataRuangController@create_dataRuang');
		Route::match(['get', 'patch'], '/{id}/update', 'i_admin\data_adminController\dataRuangController@update_dataRuang');
		Route::delete('/{id}/delete', 'i_admin\data_adminController\dataRuangController@destroy_dataRuang');
	});

	Route::group(['prefix' => '/trans_peminjaman'], function() {
		Route::get('/', 'i_admin\trans_adminController\t_peminjamanController@index_dataTransaksi');
		Route::match(['get', 'post'], '/create', 'i_admin\trans_adminController\t_peminjamanController@create_dataTransaksi');
		Route::match(['get', 'patch'], '/{id}/kembalikan', 'i_admin\trans_adminController\t_peminjamanController@kembalikan_dataTransaksi');
		Route::patch('/{id}/izinkan', 'i_admin\trans_adminController\t_peminjamanController@izinkan_dataTransaksi');
		Route::get('/{id}/detail', 'i_admin\trans_adminController\t_peminjamanController@detail_dataTransaksi');
	});

	Route::group(['prefix' => '/trans_pengembalian'], function() {
		Route::get('/', 'i_admin\trans_adminController\t_pengembalianController@index_dataTransaksi');
		Route::get('/{id}/detail', 'i_admin\trans_adminController\t_pengembalianController@detail_dataTransaksi');
	});

	

	
		Route::get('/laporan_peminjaman', 'i_admin\lapor_adminController\laporPeminjamanController@index_dataTransaksi');
		Route::get('/laporan_pengembalian', 'i_admin\lapor_adminController\laporPengembalianController@index_dataTransaksi');
	

	Route::match(['get', 'post'], '/export_to_pdf_tpeminjaman','i_admin\lapor_adminController\laporPeminjamanController@export_pdf');
	Route::match(['get', 'post'], '/export_to_pdf_tpengembalian','i_admin\lapor_adminController\laporPengembalianController@export_pdf');
});
################
### OPERATOR ###
################

Route::group(['prefix' => '/operator', 'middleware' => 'check_level'], function() {
	Route::get('/', 'i_operator\operatorController@index_operatorTransaksi');
	Route::match(['get', 'post'], '/create', 'i_operator\operatorController@create_operatorTransaksi');
	Route::match(['get', 'patch'], '/{id}/kembalikan', 'i_operator\operatorController@kembalikan_operatorTransaksi');
	Route::patch('/{id}/izinkan', 'i_operator\operatorController@izinkan_operatorTransaksi');
	Route::get('/{id}/detail', 'i_operator\operatorController@detail_operatorTransaksi');

	Route::group(['prefix' => '/trans_pengembalian'], function() {
		Route::get('/', 'i_operator\t_pengembalianController@index_operatorTransaksi');
		Route::get('/{id}/detail', 'i_operator\t_pengembalianController@detail_operatorTransaksi');
	});
});

################
### PEMINJAM ###
################
Route::group(['prefix' => '/peminjam', 'middleware' => 'check_level'], function() {
	Route::get('/', 'i_peminjam\peminjamController@index_peminjamTransaksi');
	Route::match(['get', 'post'], '/create', 'i_peminjam\peminjamController@create_peminjamTransaksi');
	Route::get('/{id}/detail', 'i_peminjam\peminjamController@detail_peminjamTransaksi');
});

