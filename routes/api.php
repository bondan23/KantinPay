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

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('history', 'API\UserController@history');
    Route::post('transfer', 'API\UserController@transfer');
    Route::get('logout', 'API\UserController@logout');

    Route::post('topup', [
        'as' => 'topup',
        'uses' => 'API\UserController@topup',
        'needs' => 'TOPUP.CREATE',
        'middleware' => 'guard'
    ]);

    Route::post('request_topup', [
        'as' => 'request_topup',
        'uses' => 'API\UserController@request_topup',
        'needs' => 'ACCESS.CREATE',
        'middleware' => 'guard'
    ]);
    
    Route::get('details', [
        'as' => 'details',
        'uses' => 'API\UserController@details',
        'needs' => 'ACCESS.READ',
        'middleware' => 'guard'
    ]);
});