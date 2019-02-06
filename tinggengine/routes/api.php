<?php

//use Illuminate\Http\Request;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//User Controller 
Route::get('users/', 'UsersController@index');
Route::get('users/{id}', 'UsersController@get');
Route::post('users/', 'UsersController@save');
Route::post('login/', 'UsersController@login');
Route::put('users/', 'UsersController@update');
Route::delete('users/{id}', 'UsersController@archive');
Route::get('users/{offset}/{limit?}', 'Users@index');


//Product Categories
Route::get('products/categories/', 'ProductCategoryController@index');
Route::get('products/categories/{id}', 'ProductCategoryController@get');
Route::post('products/categories/', 'ProductCategoryController@save');
Route::put('products/categories/', 'ProductCategoryController@update');
Route::delete('products/categories/{id}', 'ProductCategoryController@archive');
Route::get('products/categories/{offset}/{limit?}', 'ProductCategoryController@index');


//Products 
Route::get('products/', 'ProductController@index');
Route::get('products/{id}', 'ProductController@get');
Route::post('products/', 'ProductController@save');
Route::put('products/', 'ProductController@update');
Route::delete('products/{id}', 'ProductController@archive');
Route::get('products/{offset}/{limit?}', 'ProductController@index');


