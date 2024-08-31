<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            "company_type_id" => "nullable",
            "industry_id" => "nullable",
            "name" => "nullable",
            "company_size_id" => "nullable",
            "country" => "nullable",
            "city" => "nullable",
            "cac" => "nullable",
            "website" => "nullable",
            "address" => "nullable",
            "phone" => "nullable",
            "email" => "nullable",
            // "image" => "nullable",
            "description" => "nullable",
            "employee" => "nullable",
            "date_founded" => "nullable",
            "tech_stack" => "nullable",
            "instagram" => "nullable",
            "twitter" => "nullable",
            "facebook" => "nullable",
            "youtube" => "nullable",
            "linkedin" => "nullable",
        ];
    }
}
