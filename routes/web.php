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

Route::get('/', 'ScoreController@index');
Route::get('/score', 'ScoreController@index');
Route::get('/score/{value?}', 'ScoreController@index');
Route::post('/', 'ScoreController@store');
Route::post('/score', 'ScoreController@store');