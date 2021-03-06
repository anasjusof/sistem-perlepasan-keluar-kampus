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

        $checkSearch = 0;

        $queries = [];

        $current_user_f_id = Auth::user()->faculties_id;

        $directory = '/images/';

        $histories = LecturerHistory::select('users.name', 'users.email','lecturer_histories.id as history_id','lecturer_histories.reason','lecturer_histories.date_from','lecturer_histories.date_to','lecturer_histories.created_at', 'lecturer_histories.approval_status', 'attachments.filepath')
                                    ->join('users', 'lecturer_histories.users_id', '=', 'users.id')
                                    ->join('attachments', 'lecturer_histories.attachments_id', '=', 'attachments.id')
                                    ->where('users.faculties_id', '=', $current_user_f_id);

        if(request()->has('status')){

            $histories = $histories->where('lecturer_histories.approval_status', '=', request('status'));

            $queries['status'] = request('status');

            $checkSearch++;
        }

        if($checkSearch == 0){

            $histories = $histories->orderBy('lecturer_histories.id', 'DESC')
                                    ->paginate(5);

            return view('ketuajabatan.index', compact('histories', 'directory'));
        }

        else{
            $histories = $histories->orderBy('lecturer_histories.id', 'DESC')
                                    ->paginate(5)->appends($queries);

            return view('ketuajabatan.index', compact('histories', 'directory'));
        }

    	// $histories = LecturerHistory::select('users.name', 'users.email','lecturer_histories.id as history_id','lecturer_histories.reason','lecturer_histories.date_from','lecturer_histories.date_to','lecturer_histories.created_at', 'lecturer_histories.approval_status', 'attachments.filepath')
    	// 							->join('users', 'lecturer_histories.users_id', '=', 'users.id')
    	// 							->join('attachments', 'lecturer_histories.attachments_id', '=', 'attachments.id')
     //                                ->where('users.faculties_id', '=', $current_user_f_id)
    	// 							->orderBy('lecturer_histories.id', 'DESC')
    	// 							->paginate(5);

    	

    	 

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

            // If not rejected, then only create data for Dekan for approval.
            if($status != 2){
               HeadDepartmentHistory::create($input); 
            }
            

        }

        return redirect()->back();
    }
}
