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

Route::get('/', [
    'uses' => 'SitesController@index',
    'as' => 'home',
]);
Route::get('/add', [
    'uses' => 'SitesController@add',
    'as' => 'add',
]);
Route::get('/insurance', [
    'uses' => 'SitesController@insurance',
    'as' => 'insurance',
]);
Route::get('/search', [
    'uses' => 'SitesController@search',
    'as' => 'search',
]);
Route::get('/base', [
    'uses' => 'SitesController@base',
    'as' => 'base',
]);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
