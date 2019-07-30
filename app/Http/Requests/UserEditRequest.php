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
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->get('id') . ',id,deleted_at,NULL',
            'phone' => 'required',
            'nric' => 'required',
            'permit_no' => 'required',
            'nationality_id' => 'required',
            'role_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'User name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already occupied',
            'phone.required' => 'Phone is required',
            'nric.required' => 'NRIC is required',
            'permit_no.required' => 'Permit number is required',
            'nationality_id.required' => 'Nationality is required',
            'role_id.required' => 'Role is required',
        ];
    }
}
