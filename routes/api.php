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




//Stock 
Route::get('stock/', 'StockController@index');
Route::get('stock/{id}', 'StockController@get');
Route::post('stock/', 'StockController@save');
Route::put('stock/', 'StockController@update');
Route::delete('stock/{id}', 'StockController@archive');
Route::get('stock/{offset}/{limit?}', 'StockController@index');




//Stock 
Route::get('stockist/', 'StockistController@index');
Route::get('stockist/validatereference/{reference_id}', 'StockistController@checkrefence');
Route::get('stockist/{id}', 'StockistController@get');
Route::post('stockist/', 'StockistController@save');
Route::put('stockist/', 'StockistController@update');
Route::delete('stockist/{id}', 'StockistController@archive');
Route::get('stockist/{offset}/{limit?}', 'StockistController@index');




//Dealer 
Route::get('dealer/', 'DealerController@index');
Route::get('dealer/validatereference/{reference_id}', 'DealerController@checkrefence');
Route::get('dealer/{id}', 'DealerController@get');
Route::post('dealer/', 'DealerController@save');
Route::put('dealer/', 'DealerController@update');
Route::delete('dealer/{id}', 'DealerController@archive');
Route::get('dealer/{offset}/{limit?}', 'DealerController@index');




//Dealer 
Route::get('driver/', 'DriverController@index');
Route::get('driver/validatereference/{reference_id}', 'DriverController@checkrefence');
Route::get('driver/{id}', 'DriverController@get');
Route::post('driver/', 'DriverController@save');
Route::put('driver/', 'DriverController@update');
Route::delete('driver/{id}', 'DriverController@archive');
Route::get('driver/{offset}/{limit?}', 'DriverController@index');





//Purchase Orders 
Route::get('purchases/', 'PurchaseController@index');
Route::get('purchases/validatereference/{reference_id}', 'PurchaseController@checkrefence');
Route::get('purchases/{id}', 'PurchaseController@get');
Route::post('purchases/', 'PurchaseController@save');
Route::put('purchases/', 'PurchaseController@update');
Route::delete('purchases/{id}', 'PurchaseController@archive');
Route::get('purchases/{offset}/{limit?}', 'PurchaseController@index');



