<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
        Route::get('/', function(){
            return Auth::user()->level;
        })->middleware('jwt.verify');

Route::get('user','PetugasController@getAuthenticatedUser');

//mapel
Route::post('/simpan_mapel','MapelController@store')->middleware('jwt.verify');
Route::put('/ubah_mapel/{id}','MapelController@update')->middleware('jwt.verify');
Route::delete('/hapus_mapel/{id}','MapelController@hapus')->middleware('jwt.verify');
Route::get('/tampil_mapel','MapelController@tampil')->middleware('jwt.verify');

//dairy
Route::post('/simpan_diary','DiaryController@store')->middleware('jwt.verify');
Route::put('/ubah_diary/{id}','DiaryController@update')->middleware('jwt.verify');
Route::delete('/hapus_diary/{id}','DiaryController@hapus')->middleware('jwt.verify');
Route::get('/tampil_diary','DiaryController@tampil')->middleware('jwt.verify');

//reminder
Route::post('/simpan_reminder','ReminderController@store')->middleware('jwt.verify');
Route::put('/ubah_reminder/{id}','ReminderController@update')->middleware('jwt.verify');
Route::delete('/hapus_reminder/{id}','ReminderController@hapus')->middleware('jwt.verify');
Route::get('/tampil_reminder','ReminderController@tampil')->middleware('jwt.verify');

//buku
Route::post('/simpan_buku','BukuController@store')->middleware('jwt.verify');
Route::put('/ubah_buku/{id}','BukuController@update')->middleware('jwt.verify');
Route::delete('/hapus_buku/{id}','BukuController@hapus')->middleware('jwt.verify');
Route::get('/tampil_buku','BukuController@tampil');

//detail
Route::post('/simpan_detail','TransaksiController@simpan')->middleware('jwt.verify');
Route::put('/ubah_detail/{id}','TransaksiController@ubah')->middleware('jwt.verify');
Route::delete('/hapus_detail/{id}','TransaksiController@destroy')->middleware('jwt.verify');
Route::get('/tampil_detail','TransaksiController@tampil_detail')->middleware('jwt.verify');

//transaksi
Route::post('/simpan_transaksi','TransaksiController@store')->middleware('jwt.verify');
Route::put('/ubah_transaksi/{id}','TransaksiController@update')->middleware('jwt.verify');
Route::delete('/hapus_transaksi/{id}','TransaksiController@hapus')->middleware('jwt.verify');

//report
Route::get('/report/{tgl_transaksi}/{tgl_selesai}','DetailController@report')->middleware('jwt.verify');


