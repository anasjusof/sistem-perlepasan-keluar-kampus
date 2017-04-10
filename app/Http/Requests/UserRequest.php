<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserRequest extends Request
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
                'email'=>'required|email|unique:users',
                'password'=>'required|confirmed',
            ];
        }

        if($this->method() == 'PUT' || $this->method() == 'PATCH')
        {
            return [
                'name'=>'required',
            ];
        }
    }
}
