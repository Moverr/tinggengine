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

Route::get('users/', 'Users@index');

Route::get('users/{id}', 'Users@show');
Route::post('users', 'Users@store');
Route::put('users/{id}', 'Users@update');
Route::delete('users/{id}', 'Users@delete');
Route::get('users/{offset}/{limit?}', 'Users@index');
