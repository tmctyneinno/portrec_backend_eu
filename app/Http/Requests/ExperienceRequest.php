<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "company_name" => "required",
            "company_location" => "required",
            "start_date" => "required",
            "end_date" => "sometimes",
            "job_title" => "required",
            "job_level" => "sometimes",
            "job_function_id" => "required",
            "salary_range" => "sometimes",
            "work_type_id" => "required",
            "description" => "sometimes",
            "status" => "sometimes"
        ];
    }


    public function messages(): array
    {
        return [
            "company_name.required" => "company_name is required",
            "company_location.required" => "qualification is required",
            "start_date.required" => "start date is required",
            "job_title.required" => "job title  is required",
            "job_function_id.required" => "job function id is required",
            "work_type_id" => "work type id is required"
        ];
    }
}
