<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DestinationSearchRequest extends FormRequest
{
        public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        
        $this->merge([
            'activity' => $this->stripTags('activity'),
            'travel_month' => $this->stripTags('travel_month'),
            'max_budget' => $this->query('max_budget', $this->input('max_budget')),
        ]);
    }


    public function rules(): array
    {
        return [
            'activity' => ['nullable', 'string', 'max:100'],
            'max_budget' => ['nullable', 'numeric', 'min:0'],
            'travel_month' => ['nullable', 'string', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'max_budget.numeric' => 'The max_budget parameter must be a valid number.',
            'max_budget.min' => 'The max_budget parameter must be zero or greater.',
            'activity.max' => 'The activity parameter must not exceed 100 characters.',
            'travel_month.max' => 'The travel_month parameter must not exceed 20 characters.',
        ];
    }

    protected function stripTags($field): ?string
    {
        return $this->input($field) ? strip_tags($this->input($field)) : null;
    }
}
