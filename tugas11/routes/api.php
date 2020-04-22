<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/getData','DataKaryawan@getData');

Route::post('/pushData','DataKaryawan@data');

Route::post('/setData','DataKaryawan@update');

Route::get('/delete/{id}','DataKaryawan@hapus');

Route::get('/getDetail/{id}','DataKaryawan@getDetail');
