<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class DrillingRigEntryRequest extends FormRequest
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
            'rig_no'        => 'required|unique:drilling_rigs,rig_no,NULL,id,deleted_at,NULL',
            'model'         => 'required',
            'year_made'     => 'required|integer|digits:4|max:' . date('Y'),
        ];
    }

    public function messages()
    {
        return [
            'rig_no.required' => 'Rig No. is required',
            'rig_no.unique' => 'Rig No. is already taken',
            'model.required' => 'Model is required',
            'year_made.required' => 'Year is required',
            'year_made.integer' => 'Year must be integer',
            'year_made.digits' => 'Year must be 4-digits',
            'year_made.max' => 'Year must not be more than ' . date('Y'),
        ];
    }
}
