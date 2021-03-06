<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;

use App\HeadDepartmentHistory;
use App\LecturerHistory;
use App\Attachment;

class DeansController extends Controller
{
    public function index(){

        $checkSearch = 0;

        $queries = [];

        $directory = '/images/';

        $current_user_f_id = Auth::user()->faculties_id;

    	$histories = LecturerHistory::select('users.name', 'users.email','head_department_histories.id as history_id','lecturer_histories.reason','lecturer_histories.date_from','lecturer_histories.date_to','lecturer_histories.created_at', 'head_department_histories.approval_status', 'attachments.filepath')
    								->rightJoin('head_department_histories', 'head_department_histories.lecturer_histories', '=', 'lecturer_histories.id')
    								->join('users', 'lecturer_histories.users_id', '=', 'users.id')
                                    ->join('attachments', 'lecturer_histories.attachments_id', '=', 'attachments.id')
                                    ->where('users.faculties_id', '=', $current_user_f_id);

    	if(request()->has('status')){

            $histories = $histories->where('head_department_histories.approval_status', '=', request('status'));

            $queries['status'] = request('status');

            $checkSearch++;
        }

        if($checkSearch == 0){

            $histories = $histories->orderBy('head_department_histories.lecturer_histories', 'DESC')
                                    ->paginate(5);

            return view('dekan.index', compact('histories', 'directory')); 
        }

        else{
            $histories = $histories->orderBy('head_department_histories.lecturer_histories', 'DESC')
                                    ->paginate(5)->appends($queries);

            return view('dekan.index', compact('histories', 'directory')); 
        }

    	

    }

    public function approveReject(Request $request){
    	$request->all();

    	foreach($request->history as $history){

    		$pieces = explode("-", $history);
            $history_id = $pieces[0];
            $status = $pieces[1];

            $lecturerHistory = HeadDepartmentHistory::find($history_id);

            $lecturerHistory->approval_status = $status;

            $lecturerHistory->save();

        }

        return redirect()->back();
    }
}
