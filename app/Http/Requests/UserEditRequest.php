<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
        return [
            'name'              => 'required',
            'email'             => 'required|email|unique:users,email,' . $this->get('id') . ',id,deleted_at,NULL',
            'password'          => 'required_if:set_password,==,on|confirmed|min:6',
            'password_confirmation' => 'required_if:set_password,==,on|min:6',
            'phone'             => 'required|numeric',
            'nric'              => 'required|numeric|unique:users,nric,' . $this->get('id') . ',id,deleted_at,NULL',
            'permit_no'         => 'required|numeric|unique:users,permit_no,' . $this->get('id') . ',id,deleted_at,NULL',
            'nationality_id'    => 'required',
            'role_id'           => 'required',
            // 'signature' => 'required_if:role_id,==,2|mimes:jpeg,jpg,png,JPG,JPEG,PNG|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => 'User name is required',
            'email.required'    => 'Email is required',
            'email.unique'      => 'Email is already taken',
            'phone.required'    => 'Phone is required',
            'phone.numeric'     => 'Phone must be numeric',
            'nric.required'     => 'NRIC is required',
            'nric.numeric'      => 'NRIC must be numeric',
            'nric.unique'      => 'NRIC is already taken',
            'permit_no.required' => 'Permit number is required',
            'permit_no.numeric' => 'Permit number must be numeric',
            'permit_no.unique' => 'Permit number is already taken',
            'nationality_id.required' => 'Nationality is required',
            'role_id.required'  => 'Role is required',
            // 'signature.required_if' => 'Signature is required if role is supervisor',
        ];
    }
}
