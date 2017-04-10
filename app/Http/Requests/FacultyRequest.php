<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FacultyRequest extends Request
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
                'name'=>'required',
                'code'=>'required',
            ];
        }
    }

    public function messages(){

        return [
            'name.required'=>'Faculty name is required',
            'code.required'=>'Faculty code is required',
        ];
    }
}
