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
    return view('dashboard');
});


Route::resource('system-managemnt/country','CountryController');
Route::post('system-managemnt/country/search','CountryController@search')->name('country.search');


Route::resource('management/employee','EmployeeController');
Route::post('management/employee/search','EmployeeController@search')->name('employee.search');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
