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

Route::get('system-management/report', 'ReportController@index');
Route::post('system-management/report/search', 'ReportController@search')->name('report.search');
Route::post('system-management/report/pdf', 'ReportController@exportPDF')->name('report.pdf');
Route::post('system-management/report/excel', 'ReportController@exportExcel')->name('report.excel');

Auth::routes();
