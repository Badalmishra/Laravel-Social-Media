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

Auth::routes(['verify' => true]);
Route::get('/', 'pagescontroller@index')->middleware('verified');
Route::get('/find', 'find@index')->middleware('verified');
Route::post('/find/search', 'find@search')->middleware('verified');
Route::resource('follow', 'follow')->middleware('verified');
Route::resource('photo', 'photoscontroller')->middleware('verified');
Route::resource('artists', 'profile')->middleware('verified');
Route::post('/artist/bio', 'profile@bio')->middleware('verified');
Route::post('/artist/cover', 'profile@cover')->middleware('verified');
Route::delete('/artist/delcover', 'profile@delcover')->middleware('verified');

Route::delete('/artist/delbio', 'profile@delbio')->middleware('verified');
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');
