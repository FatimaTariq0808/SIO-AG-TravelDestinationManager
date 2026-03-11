<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationPaginationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    protected function prepareForValidation(): void
    {
        $this->merge([
            'per_page' => $this->query('per_page', $this->input('per_page', 10)),
            'order' => strtolower((string) $this->query('order', $this->input('order', 'desc'))),
        ]);
    }
    public function rules(): array
    {
        return [
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
            'order' => ['nullable', 'in:asc,desc']
        ];
    }
    public function messages(): array
    {
        return [
            'per_page.integer' => 'The per_page parameter must be an integer.',
            'per_page.min' => 'The per_page parameter must be at least 1.',
            'per_page.max' => 'The per_page parameter cannot exceed 100.',
            'order.in' => 'The order parameter must be either asc or desc.'
        ];
    }
}
