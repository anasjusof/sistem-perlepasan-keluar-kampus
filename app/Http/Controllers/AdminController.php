<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Http\Requests\FacultyRequest;

use App\Faculty;
use App\User;
use App\Role;

class AdminController extends Controller
{
    public function index(){

        $admin = User::where('roles_id', '=', 1)->get();
        $dekan = User::where('roles_id', '=', 2)->get();
        $ketuajabatan = User::where('roles_id', '=', 3)->get();
        $pensyarah = User::where('roles_id', '=', 4)->get();

        return view('admin.dashboard', compact('admin', 'dekan', 'ketuajabatan', 'pensyarah'));
    }
    
    public function manageFaculty(){

    	$faculties = Faculty::paginate(5);

    	return view('admin.manage-faculty', compact('faculties'));
    }

    public function createFaculty(FacultyRequest $request){
    	$input = $request->all();

    	Faculty::create($input);

    	return redirect()->back()->with('create_message', 'Faculty successfully created!');
    }

    public function deleteFaculty(Request $request){
    	$faculties = Faculty::findOrFail($request->faculty_id);

    	foreach($faculties as $faculty){
    		$faculty->delete();
    	}

    	return redirect()->back()->with('delete_message', 'Faculty successfully deleted!');
    }

    public function manageUser(){
    	$users = User::select('users.*', 'faculties.id as faculties_id', 'roles.id as roles_id', 'roles.name as role_name', 'faculties.name as faculty_name')
    					->join('roles', 'roles.id', '=', 'users.roles_id')
    					->leftJoin('faculties', 'faculties.id', '=', 'users.faculties_id')
                        ->orderBy('id', 'DESC')
    					->paginate(5);

    	$roles = Role::lists('name', 'id');

    	$faculties = Faculty::lists('name', 'id');

    	return view('admin.manage-user', compact('users', 'roles', 'faculties'));
    }

    public function createUser(UserRequest $request){

        $input = $request->except('password_confirmation');

        if($input['roles_id'] == 1){
            $input['faculties_id'] = 0;
        }

        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return redirect()->back()->with('create_message', 'User successfully created!');

    }

    public function editUser(UserRequest $request){
        $input = $request->except('password_confirmation');

        if($input['roles_id'] == 1){
            $input['faculties_id'] = 0;
        }
        $user = User::findOrFail($input['id']);

        $user->name = $input['name'];

        if(!empty($input['password'])){
            $user->password = bcrypt($input['password']);
        }
        
        $user->roles_id = $input['roles_id'];
        $user->faculties_id = $input['faculties_id'];

        $user->save();

        return redirect()->back()->with('update_message', 'User info successfully updated!');
    }

	public function deleteUser(Request $request){

        foreach($request->users_id as $id){
            $user = User::findOrFail($id);

            $user->delete();
        }

        return redirect()->back()->with('create_message', 'User successfully deleted!');

    }

}
