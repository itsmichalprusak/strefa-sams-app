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

Route::post('/add', [
    'uses' => 'SitesController@addemployee',
    'as' => 'addemployee',
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

Route::get('/home', [
    'uses' => 'SitesController@home',
    'as' => 'home',
]);

Route::get('/user', [
    'uses' => 'SitesController@user',
    'as' => 'user',
]);

Route::get('/patient', [
    'uses' => 'SitesController@patient',
    'as' => 'patient',
]);

Route::post('/patient', [
    'uses' => 'SitesController@addpatient',
    'as' => 'addpatient',
]);


Auth::routes();
