<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileEditRequest extends FormRequest
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
            // 'password' => 'required|confirmed|min:6',
            // 'password_confirmation' => 'required',
            'phone' => 'required|numeric',
            'nric' => 'required|numeric',
            'permit_no' => 'required|numeric',
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
            // 'password.required' => 'Password is required',
            // 'password.confirmed' => 'Passwords do not match',
            // 'password.min' => 'Password must be at least 6 characters',
            // 'password_confirmation.required' => 'Password confirmation is required',
            'phone.required' => 'Phone is required',
            'phone.numeric' => 'Phone must be numeric',
            'nric.required' => 'NRIC is required',
            'nric.numeric' => 'NRIC must be numeric',
            'permit_no.required' => 'Permit number is required',
            'permit_no.numeric' => 'Permit number must be numeric',
            'nationality_id.required' => 'Nationality is required',
            'role_id.required' => 'Role is required',
        ];
    }
}
