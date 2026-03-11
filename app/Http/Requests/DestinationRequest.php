<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class DestinationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->stripTags('name'),
            'activities' => $this->sanitizeArray('activities'),
            'best_travel_months' => $this->sanitizeArray('best_travel_months'),
            'average_cost' => $this->input('average_cost')
        ]);
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'activities' => 'required|array',
            'activities.*' => 'string|max:100',
            'average_cost' => 'required|numeric|min:0',
            'best_travel_months' => 'required|array',
            'best_travel_months.*' => 'string|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'activities.array' => 'Activities must be as an array of strings.',
            'activities.*.string' => 'Each activity must be a string.',
            'activities.*.max' => 'Each activity must not exceed 100 characters.',
            'best_travel_months.array' => 'Best travel months must be as an array of strings.',
            'best_travel_months.*.string' => 'Each best travel month must be a string.',
            'best_travel_months.*.max' => 'Each best travel month must not exceed 20 characters.',
            'average_cost.numeric' => 'Average cost must be a valid number.',
            'average_cost.min' => 'Average cost cannot be negative.'
        ];
    }
    protected function stripTags($field): ?string
    {
        return $this->input($field) ? strip_tags($this->input($field)) : null;
    }
    private function sanitizeArray(string $field): mixed
    {
        $value = $this->input($field, []);

        if (!is_array($value)) {
            return $value;
        }

        return array_map(function ($item) { return is_string($item) ? strip_tags($item) : $item; }, $value);
    }
}