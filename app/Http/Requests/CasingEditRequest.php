<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class CasingEditRequest extends FormRequest
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
            'name'  => 'required|unique:casings,name,' . $this->get('id') . ',id,deleted_at,NULL',
            'od'    => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'name.unique'   => 'Name is already taken',
            'od.required'   => 'OD is required',
            'od.numeric'   => 'OD must be numeric',
        ];
    }
}
