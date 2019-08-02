<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class ProjectEntryRequest extends FormRequest
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
            'project_id' => 'required|unique:projects,project_id,NULL,id,deleted_at,NULL',
            'name' => 'required|unique:projects,name,NULL,id,deleted_at,NULL',
            'client_name' => 'required',
            'contract_number' => 'required|unique:projects,contract_number,NULL,id,deleted_at,NULL',
            'project_start_date' => 'required',
            'location' => 'required_without:has_wo',
            'location_plan' => 'mimes:jpeg,jpg,png,zip,doc,docx,pdf,xls,xlsx,txt|max:5000',
            'number_of_bh' => 'min:1',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'Project ID is required',
            'project_id.unique' => 'Project ID is already taken',
            'name.required' => 'Project name is required',
            'name.unique' => 'Project name is already taken',
            'client_name.required' => 'Client name is required',
            'contract_number.required' => 'Contract number is required',
            'contract_number.unique' => 'Contract number is already taken',
            'project_start_date.required' => 'Project start date is required',
            'location.required_without' => 'Location is required when has WO is not present',
            'location_plan.mimes' => 'File extension is invalid. Please upload only the following : jpeg,jpg,png,zip,doc,docx,pdf,xls,xlsx,txt',
            'location_plan.max' => 'File size should not be more than 5MB',
            'number_of_bh.min' => 'Number of bore holes must be greater than 0',
        ];
    }
}
