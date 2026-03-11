<?php

namespace App\Models\Document;

use MongoDB\Laravel\Eloquent\Model;
class Destination extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'destinations';
    protected $primaryKey = '_id';
    protected $fillable = [
        'name',
        'activities',
        'average_cost',
        'best_travel_months'
    ];

    protected $casts = [
        'activities' => 'array',
        'best_travel_months' => 'array',
        'average_cost' => 'float'
    ];
}