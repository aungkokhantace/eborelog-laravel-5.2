<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WOEntryRequest extends FormRequest
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
            'wo_number' => 'required|unique:project_wo,wo_number,NULL,id,deleted_at,NULL',
            'number_of_bh' => 'required|min:1',
            'wo_start_date' => 'required',
            'location' => 'required',
            'location_plan' => 'mimes:jpeg,jpg,png,JPEG,JPG,PNG,zip,doc,docx,pdf,xls,xlsx,txt|max:5000',
        ];
    }

    public function messages()
    {
        return [
            'wo_number.required' => 'WO number is required',
            'wo_number.unique' => 'WO number is already taken',
            'number_of_bh.required' => 'Number of bore holes is required',
            'number_of_bh.min' => 'Number is bore holes must be greater than 0',
            'wo_start_date.required' => 'WO start date is required',
            'location.required' => 'Location is required',
            'location_plan.mimes' => 'File extension is invalid. Please upload only the following : jpeg,jpg,png,zip,doc,docx,pdf,xls,xlsx,txt',
            'location_plan.max' => 'File size should not be more than 5MB',
        ];
    }
}
