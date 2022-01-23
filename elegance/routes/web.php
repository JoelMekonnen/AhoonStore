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
Route::get('/', 'IndexController@Homepage')->name('index');
Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/register', 'adminController@adminSign')->name('adminRegister');
Route::post('/admin/register', 'adminController@create')->name('adminRegisterCreate');
Route::get('/user/create', 'profilesController@showUserCreate')->name('createUsers');
Route::post('/user/create', 'profilesController@createUsers')->name('createUserPost');
Route::middleware('auth:web')->group(function() {
    Route::post('/admin/product/create', 'productController@create')->name('productCreate');
    Route::get('/admin/products/show', 'productController@showProducts')->name('showProds');
    Route::get('/admin/products/{id}/update', 'productController@getUpdateProduct')->name('getUpdateProds');
    Route::post('/admin/products/{id}/update', 'productController@updateProduct')->name('putUpdateProds');
    Route::get('/admin/category/create', 'catagories@catCreate')->name('createCat');
    Route::post('/admin/category/create', 'catagories@catUpload')->name('catUpload');
    Route::get('/Order/{id}/get', 'orderController@getOrder')->name('getProdOrder');
    Route::post('/Order/{id}/create', 'orderController@createOrder')->name('createProdOrder');
    Route::get('/Order/get/pending', 'orderController@getOrderRequests')->name('getRequest');
    Route::get('/Order/get/declined', 'orderController@getDeclinedRequests')->name('getDeclinedRequest');
    Route::get('/Order/get/approved', 'orderController@getApprovedRequests')->name('getApprovedRequest');
    Route::get('/Order/{id}/action/{action}', 'orderController@postOrderAction')->name('adminOrderAction');
    Route::get('/admin/', 'adminController@adminHome')->name('adminHome');
    Route::get('/user/', 'profilesController@Index')->name('userHome');
});



