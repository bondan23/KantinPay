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
    Route::get('test', 'API\UserController@test');
    Route::post('transfer', 'API\UserController@transfer');
    Route::get('logout', 'API\UserController@logout');
    
    Route::get('details', [
        'as' => 'details',
        'uses' => 'API\UserController@details',
        'needs' => 'ACCESS.READ',
        'middleware' => 'guard'
    ]);
});