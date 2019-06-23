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

Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::post('/login','Auth\LoginController@login');
Route::get('/logout','Auth\LoginController@logout');
Route::get('/home','HomeViewController@index');

Route::get('/action_topup/{type}/{id}', [
    'as' => 'action_topup',
    'uses' => 'HomeViewController@action_topup',
    'needs' => 'ACCESS.UPDATE|ACCESS.DELETE',
]);

Route::get('/action_withdraw/{type}/{id}', [
    'as' => 'action_withdraw',
    'uses' => 'HomeViewController@action_withdraw',
    'needs' => 'ACCESS.UPDATE|ACCESS.DELETE',
]);
