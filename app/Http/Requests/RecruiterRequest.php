<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RecruiterRequest extends  FormRequest
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
            "fullName" => "required",
            "email" => "required|email",
            "password" => "required",
            "phone" => "numeric|nullable",
            "company_name" => "required|string"
        ];
    }

    public function messages(): array
    {
        return [
            "fullName.required" => "name is required",
            "phone.numeric" => "phone must be a number",
            "email.email" => "input a valid email",
            "email.required" => "email is required",
        ];
    }
}
