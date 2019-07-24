<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class PermissionEditRequest extends FormRequest
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
            'permission_module_name' => 'required',
            'permission_action' => 'required',
            'route_name' => 'required|string|unique:permissions,route_name,' . $this->get('id') . ',id,method,' . Input::get('method') . ',deleted_at,NULL',
            'method' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'permission_module_name.required' => 'Module name is required',
            'permission_action.required' => 'Action is required',
            'route_name.required' => 'Route name is required',
            'route_name.unique' => 'Route name and method combination is already occupied',
            'method.required' => 'Form request method is required',
        ];
    }
}
