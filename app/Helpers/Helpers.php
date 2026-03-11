<?php


if (!function_exists('normalizeArrayField')) {
    function normalizeArrayField(mixed $value): array
    {
        if (is_array($value)) {
            return array_map(fn($i) => strtolower(trim((string) $i)), $value);
        }

        if (is_string($value) && str_starts_with($value, '[') && str_ends_with($value, ']')) {
            $decoded = json_decode($value, true);
            if (is_array($decoded)) {
                return array_map(fn($i) => strtolower(trim((string) $i)), $decoded);
            }
        }

        if (is_string($value) && $value !== '') {
            return [strtolower(trim($value))];
        }
        return [];
    }
}