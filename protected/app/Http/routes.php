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

Route::get('/', 'StaticController@home');
Route::get('/about', 'StaticController@about');

Route::get('/r/to-monzo-auth', 'MonzoController@redirectToMonzoAuth');
Route::get('/r/from-monzo-auth', 'MonzoController@redirectFromMonzoAuth');
Route::get('/r/to-monzo-refresh', 'MonzoController@redirectToMonzoRefresh');
Route::get('/accounts', 'MonzoController@getAccounts');
Route::get('/transactions', 'MonzoController@getTransactions');
Route::get('/transactions/download', 'MonzoController@downloadTransactions');
