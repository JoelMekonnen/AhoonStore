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
Route::post('register', 'API\profilesController@register');
Route::middleware('auth:api')->group(function(){
    Route::get('products/', 'API\productController@show');
    Route::get('logout/', 'API\profilesController@logout');
    Route::get('user/get/', 'API\profilesController@getUser');
    Route::get('products/{id}', 'API\productController@showDetail');
    Route::post('order/create/', 'API\apiOrderController@createOrder');
    Route::get('user/order/pending', 'API\apiOrderController@userGetPendingHistory');
});
