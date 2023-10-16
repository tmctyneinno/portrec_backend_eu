<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "comapany_name" => "sometimes",
            "company_location" => "sometimes",
            "start_date" => "sometimes",
            "end_date" => "sometimes",
            "job_title" => "sometimes",
            "job_level" => "sometimes",
            "job_function_id" => "sometimes",
            "salary_range" => "sometimes",
            "work_type_id" => "sometimes",
            "description" => "sometimes",
            "status" => "sometimes"
        ];
    }
}