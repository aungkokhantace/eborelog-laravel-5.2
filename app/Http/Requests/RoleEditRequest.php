<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleEditRequest extends FormRequest
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
            'name' => 'required|unique:roles,name,' . $this->get('id') . ',id,deleted_at,NULL'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Role name is required',
            'name.unique' => 'Role name is already occupied',
        ];
    }
}
