<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CosProjectRequest extends FormRequest
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
            'character_name' => 'required',
            'serie_name' => 'required',
            'estimated_budget' => 'nullable|int',
            'starting_date' => 'nullable|date',
            'due_date' => 'nullable|datetime',
            'image_project' => 'nullable|file|mimes:jpeg,JPG,JPEG,PNG,png'
        ];
    }

    public function messages()
    {
        return [
            'character_name.required' => trans('cos_projects.project_name_is_required'),
            'serie_name' => trans('cos_projects.serie_name_is_required'),
            'image_project.file' => trans('cos_projects.files'),
            'image_project.mimes' => trans('cos_projects.not_allowed_mimes_type')
        ];
    }
}
