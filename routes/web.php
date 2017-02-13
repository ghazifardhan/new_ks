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


Auth::routes();

Route::get('/', function () {
    return view('auth/login');
});

/*
Route::get('/app', function () {
    return view('layouts/app');
});
*/

// Category Route

Route::resource('category', 'CategoryController');
//Route::get('/category/index', 'CategoryController@index');
//Route::get('/category/create', 'CategoryController@create');
//Route::post('/category', 'CategoryController@store');
//Route::get('/category/{id}', 'CategoryController@edit');
//Route::put('/category/{id}' , 'CategoryController@update');

// Unit Route
Route::resource('unit', 'UnitController');

// Highlight Route
Route::resource('highlight', 'HighlightController');

// Item Route
Route::resource('item', 'ItemController');

// Invoice Route
Route::resource('invoice', 'InvoiceController');

// User Route
Route::resource('user', 'UserController');

// Transaction Route
Route::resource('invoice.transaction', 'TransactionController');

// JSON Output
Route::get('/customer', 'CustomerController@autocomplete');
Route::get('/customer/voucher', 'CustomerController@populateVoucher');
Route::get('/itemJson', 'ItemController@itemJson');
Route::get('/unitJson', 'ItemController@unitJson');


Route::get('/home', 'HomeController@index');
