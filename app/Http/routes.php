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
    //return view('welcome');
    if(Auth::check()){
		if(Auth::user()->getRolesId() == 1){                // If roles id == 2, redirect to /dekan            
	      return redirect('admin');
	    }
	    if(Auth::user()->getRolesId() == 2){                // If roles id == 2, redirect to /dekan            
	      return redirect('dekan');
	    }

	    if(Auth::user()->getRolesId() == 3){                // If roles id == 2, redirect to /ketuajabatan            
	      return redirect('ketuajabatan');
	    }

	    if(Auth::user()->getRolesId() == 4){                // If roles id == 2, redirect to /pensyarah            
	      return redirect('pensyarah');
	    }
	}
	else{
		return redirect('/login');
	}
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('loginTemplate', ['uses'=>'AdminController@loginTemplate'])->name('admin.loginTemplate');


//Admin
Route::group(['middleware'=>['auth', 'checkRole:1']], function(){
	Route::get('admin/', ['uses'=>'AdminController@index'])->name('admin.index');

	Route::get('admin/manage-faculty', ['uses'=>'AdminController@manageFaculty'])->name('admin.manage-faculty');
	Route::post('admin/create-faculty', ['uses'=>'AdminController@createFaculty'])->name('admin.create-faculty');
	Route::delete('admin/delete-faculty', ['uses'=>'AdminController@deleteFaculty'])->name('admin.delete-faculty');

	Route::get('admin/manage-user', ['uses'=>'AdminController@manageUser'])->name('admin.manage-user');
	Route::post('admin/create-user', ['uses'=>'AdminController@createUser'])->name('admin.create-user');
	Route::delete('admin/delete-user', ['uses'=>'AdminController@deleteUser'])->name('admin.delete-user');
	Route::patch('admin/edit-user', ['uses'=>'AdminController@editUser'])->name('admin.edit-user');
});

//Dekan
Route::group(['middleware'=>['auth', 'checkRole:2']], function(){

	Route::get('dekan', ['uses'=>'DeansController@index'])->name('dekan.index');
	Route::post('dekan/approvereject', ['uses'=>'DeansController@approveReject'])->name('dekan.approvereject');

});

//Ketua Jabatan
Route::group(['middleware'=>['auth', 'checkRole:3']], function(){

	Route::get('ketuajabatan', ['uses'=>'HeadDepartmentController@index'])->name('ketuajabatan.index');
	Route::post('ketuajabatan/approvereject', ['uses'=>'HeadDepartmentController@approveReject'])->name('ketuajabatan.approvereject');

});

//Pensyarah
Route::group(['middleware'=>['auth', 'checkRole:4']], function(){

	Route::get('pensyarah', ['uses'=>'LecturerController@index'])->name('pensyarah.index');
	Route::post('pensyarah/permohonan', ['uses'=>'LecturerController@applyLeave'])->name('pensyarah.permohonan');

});