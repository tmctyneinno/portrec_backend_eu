<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JobApplicationAnswerRequest extends FormRequest
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
            'answers' => 'required|array',
            // 'answers.question_id' => 'required|exists:job_opening_questions,id',
            // 'answers.answer' => 'required|string|max:255',
        ];
    }
}
