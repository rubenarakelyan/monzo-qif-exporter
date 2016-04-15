<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'DefaultController@home');
$app->get('/r/to-mondo-auth', 'MondoController@redirectToMondoAuth');
$app->get('/r/from-mondo-auth', 'MondoController@redirectFromMondoAuth');
$app->get('/r/to-mondo-refresh', 'MondoController@redirectToMondoRefresh');
$app->get('/accounts', 'MondoController@getAccounts');
$app->get('/transactions', 'MondoController@getTransactions');
$app->get('/transactions/download', 'MondoController@downloadTransactions');
