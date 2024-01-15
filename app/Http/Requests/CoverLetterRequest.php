<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CoverLetterRequest extends FormRequest
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
            'user_id' => [Rule::requiredIf(function () {
                return $this->user() === null;
            }), 'nullable', 'exists:users,id'],
            'job_application_id' => 'required|exists:job_applications,id',
            'cover_letter' => 'required|string|max:10000',
            'portfolio_link' => 'nullable|string|url',
        ];
    }
}
