<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('pensyarah', ['uses'=>'LecturerController@index'])->name('pensyarah.index');
Route::post('pensyarah/permohonan', ['uses'=>'LecturerController@applyLeave'])->name('pensyarah.permohonan');

Route::get('ketuajabatan', ['uses'=>'HeadDepartmentController@index'])->name('ketuajabatan.index');
Route::post('ketuajabatan/approvereject', ['uses'=>'HeadDepartmentController@approveReject'])->name('ketuajabatan.approvereject');

Route::get('dekan', ['uses'=>'DeansController@index'])->name('dekan.index');
Route::post('dekan/approvereject', ['uses'=>'DeansController@approveReject'])->name('dekan.approvereject');


