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

Route::get('/', 'InvoiceController@index');
Route::get('/invoice', 'InvoiceController@index')->name('invoice.index');
Route::post('/invoice/search', 'InvoiceController@search')->name('invoice.search');
Route::post('/product/search', 'InvoiceController@searchProduct')->name('invoice.product.search');
