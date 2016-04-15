<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'DefaultController@home');
Route::get('/r/to-mondo-auth', 'MondoController@redirectToMondoAuth');
Route::get('/r/from-mondo-auth', 'MondoController@redirectFromMondoAuth');
Route::get('/r/to-mondo-refresh', 'MondoController@redirectToMondoRefresh');
Route::get('/accounts', 'MondoController@getAccounts');
Route::get('/transactions', 'MondoController@getTransactions');
Route::get('/transactions/download', 'MondoController@downloadTransactions');
