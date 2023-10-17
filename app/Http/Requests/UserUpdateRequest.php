<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            "name" =>  "sometimes",
            "phone" =>    "sometimes",
            "gender" =>   "sometimes",
            "dob" =>  "sometimes",
            "country" =>  "sometimes",
            "state" =>    "sometimes",
            "address" =>  "sometimes",
            "description" =>  "sometimes",
            "linkedin" =>     "sometimes",
            "twitter" =>  "sometimes",
            "facebook" =>     "sometimes",
            "website" => "sometimes",
            "instagram" =>   "sometimes",
            "googleplus" =>   "sometimes",
            "languages" =>    "sometimes",
            "title" =>    "sometimes",
            "location" =>     "sometimes",
            "about_me" =>     "sometimes"
        ];
    }
}
