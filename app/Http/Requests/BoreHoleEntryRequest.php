<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class BoreHoleEntryRequest extends FormRequest
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
            // 'name'           => 'required',
            // 'nric'           => 'required|numeric|unique:drillers,nric,NULL,id,deleted_at,NULL',
            // 'permit_no'      => 'required|numeric|unique:drillers,permit_no,NULL,id,deleted_at,NULL',
            // 'nationality_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'nric.required' => 'NRIC is required',
            'nric.numeric' => 'NRIC must be numeric',
            'nric.unique' => 'NRIC has already been taken',
            'permit_no.required' => 'Permit number is required',
            'permit_no.numeric' => 'Permit number must be numeric',
            'permit_no.unique' => 'Permit number has already been taken',
        ];
    }
}
