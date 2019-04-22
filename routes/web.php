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

Route::get('/', function () {
    return view('Select');
})->name('Home');;

Route::get('/Login', function () {
    return view('login.Login');
})->name('Login');

Route::get('/add', function () {
    return view('Base.Add');
})->name('DataBaseAdd');

Route::get('/Insurance', function () {
    return view('Insurances.List');
})->name('InsurancesList');

Route::get('/Search', function () {
    return view('Search');
})->name('Search');

Route::get('/Base/', function () {
    return view('Base.Main');
})->name('Base');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
