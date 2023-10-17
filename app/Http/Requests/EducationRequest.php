<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EducationRequest extends FormRequest
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
            "institution" => "required",
            "qualification" => "required",
            "start_date" => "required",
            "end_date" => "sometimes", // optional 
            "description" => "sometimes"
        ];
    }

    public function messages(): array
    {
        return [
            "institution.required" => "institution is required",
            "qualification.required" => "qualification is required",
            "start_date.required" => "start date is required",
        ];
    }
}