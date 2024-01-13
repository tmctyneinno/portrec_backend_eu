<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobApplicationRequest extends FormRequest
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
            'job_id' => 'required|exists:job_openings,id',
            'name' => [Rule::requiredIf(function () {
                return $this->user() === null;
            }), 'string', 'max:255'],
            'phone_number' => [Rule::requiredIf(function () {
                return $this->user() === null;
            }), 'string', 'max:20', 'unique:users,phone'],
            'email' => [Rule::requiredIf(function () {
                return $this->user() === null;
            }), 'string', 'max:255', 'unique:users,email'],
            'resume' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.exists' => 'Email already exist on our system, please login to continue your application or reset password',
            'phone_number.exists' => 'Phone number already exist on our system, please login to continue your application or reset password',
        ];
    }
}
