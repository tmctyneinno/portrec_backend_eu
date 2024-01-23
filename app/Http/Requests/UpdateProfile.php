<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'job_function_id',
            'user_level_id',
            'industries_id',
            'job_type_id',
            'language_id',
            'image_path',
            'phone',
            'availability_id',
            'preference',
            'salary_expectation',
            'gender_id',
            'professional_headline',
            'years_experience',
            'experience_level',
            'dob', 'country',
            'state',
            'address',
            'allow_search',
            'description',
            'linkedin',
            'twitter',
            'facebook',
            'avatar',
            'googleplus',
            'location',
            'about_me',
            'skills'
        ];
    }
}
