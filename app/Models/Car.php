<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'make',
        'model',
        'body_styles',
        'comfort_level',
    ];

    /**
     * Set the body styles as a JSON string.
     *
     * @param array $value
     */
    public function setBodyStylesAttribute($value)
    {
        $this->attributes['body_styles'] = json_encode($value);
    }

    public function getFullCarNameAttribute()
    {
        return "{$this->make} {$this->model}";
    }

    /**
     * Mutator para formatear correctamente el año.
     */
    public function setYearAttribute($value)
    {
        $this->attributes['year'] = (int)$value;
    }

    protected $appends = ['car_name'];
}
