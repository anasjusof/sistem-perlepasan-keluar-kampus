<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\HeadDepartmentHistory;
use App\LecturerHistory;
use App\Attachment;

class HeadDepartmentController extends Controller
{
    public function index(){

    	$histories = LecturerHistory::select('users.name', 'users.email','lecturer_histories.id as history_id','lecturer_histories.reason','lecturer_histories.date_from','lecturer_histories.date_to','lecturer_histories.created_at', 'lecturer_histories.approval_status', 'attachments.filepath')
    								->join('users', 'lecturer_histories.users_id', '=', 'users.id')
    								->join('attachments', 'lecturer_histories.attachments_id', '=', 'attachments.id')
    								->orderBy('lecturer_histories.id', 'DESC')
    								->paginate(5);

    	$directory = '/images/';

    	return view('ketuajabatan.index', compact('histories', 'directory')); 

    }

    public function approveReject(Request $request){
    	$request->all();

    	foreach($request->history as $history){

    		$pieces = explode("-", $history);
            $history_id = $pieces[0];
            $status = $pieces[1];

            $lecturerHistory = LecturerHistory::find($history_id);

            $lecturerHistory->approval_status = $status;

            $lecturerHistory->save();

            $input['users_id'] = Auth::user()->id;
            $input['lecturer_histories'] = $history_id;
            $input['approval_status'] = 0;

            HeadDepartmentHistory::create($input);

        }

        return redirect()->back();
    }
}
