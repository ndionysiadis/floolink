<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreLinkRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'original_url' => 'required|url',
            'expiration_type' => [
                'required',
                Rule::in(['default', 'never', '5', '60', '1440', '10080', 'custom']),
            ],
            'customMinutes' => [
                'required_if:expiration_type,custom',
                'nullable',
                'integer',
                'min:1',
                'max:525600',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'original_url.required' => 'Please provide a URL to encrypt.',
            'original_url.url' => 'The URL must be valid.',
            'expiration_type.required' => 'Please select an expiration type.',
            'expiration_type.in' => 'Invalid expiration type selected.',
            'customMinutes.required_if' => 'Custom minutes are required for custom expiration type.',
            'customMinutes.integer' => 'Custom minutes must be a valid number.',
            'customMinutes.min' => 'Custom minutes must be at least 1.',
            'customMinutes.max' => 'Custom minutes cannot exceed 525,600 (1 year).',
        ];
    }
}
