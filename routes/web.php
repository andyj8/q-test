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
    return view('welcome');
});

Route::match(['get', 'post'], '/botman', 'BotManController@handle');
Route::get('/botman/tinker', 'BotManController@tinker');

Route::get('/rds/list', 'RdsController@list');
Route::get('/rds/status', 'RdsController@status');
Route::get('/rds/create', 'RdsController@create');
Route::get('/rds/delete', 'RdsController@delete');
Route::get('/rds/start', 'RdsController@start');
Route::get('/rds/stop', 'RdsController@stop');

Route::get('/tags', 'RdsController@tags');
Route::get('/quote', 'RdsController@quote');
