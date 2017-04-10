<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\LecturerRequest;

use Auth;

use App\LecturerHistory;
use App\Attachment;

class LecturerController extends Controller
{
    public function index(){

    	$histories = LecturerHistory::select('users.name', 'users.email','lecturer_histories.id as history_id','lecturer_histories.reason','lecturer_histories.date_from','lecturer_histories.date_to','lecturer_histories.created_at', 'lecturer_histories.approval_status as head_department_approval_status', 'head_department_histories.approval_status', 'attachments.filepath')
    								->join('users', 'lecturer_histories.users_id', '=', 'users.id')
    								->join('attachments', 'lecturer_histories.attachments_id', '=', 'attachments.id')
                                    ->leftJoin('head_department_histories', 'lecturer_histories.id', '=', 'head_department_histories.lecturer_histories')
    								->where('users.id', '=', Auth::user()->id)
    								->orderBy('lecturer_histories.id', 'DESC')
    								->paginate(5);

    	$directory = '/images/';

    	return view('pensyarah.index', compact('histories', 'directory')); 

        

    }

    public function applyLeave(LecturerRequest $request){

    	$input = $request->all();

    	//Store receipt
    	if(!empty($input['attachment'])){

            $file = $input['attachment'];

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $attachment = Attachment::create(['filepath'=>$name]);

            $input['attachments_id'] = $attachment->id;
        }

        $date_to = strtotime($input['date_to']);
		$date_to = date('Y-m-d',$date_to);

		$date_from = strtotime($input['date_from']);
		$date_from = date('Y-m-d',$date_from);

        $input['date_to'] = $date_to;
		$input['date_from'] = $date_from;
        $input['users_id'] = Auth::user()->id;
        $input['approval_status'] = 0;

        //Store history info

    	$history = LecturerHistory::create($input);

    	return redirect()->back()->with('message', 'Permohonan anda berjaya dihantar');
    }
}