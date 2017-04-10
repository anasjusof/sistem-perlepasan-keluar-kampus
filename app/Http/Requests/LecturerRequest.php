<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LecturerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST')
        {
            return [
                'reason'=>'required',
                'date_from'=>'required',
                'date_to'=>'required',
                'attachment'=>'required',
            ];
        }
    }

    public function messages(){

        return [
            'reason.required'=>'Sila nyatakan sebab untuk keluar',
            'date_from.required'=>'Sila pilih tarikh keluar',
            'date_to.required'=>'Sila pilih tarikh pulang',
            'attachment.required'=>'Sila upload borang permohonan keluar',
        ];
    }
}
