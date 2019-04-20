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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/edit/{id}', 'HomeController@editOrder')->name('edit.order');
Route::post('/update/{id}', 'HomeController@update')->name('update.order');
Route::get('/products', 'HomeController@products')->name('products');

//Auth::routes();

