<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'make',
        'model',
        'year',
    ];

    public function getComfortLevelAttribute()
    {
        // Definimos la lógica para calcular el comfort level
        // Por ejemplo, si es un modelo de lujo, el comfort level será alto
        if ($this->model === 'Lexus' || $this->model === 'Mercedes-Benz') {
            return 5; // Alto comfort level
        } elseif (in_array($this->model, ['Toyota', 'Honda', 'Ford'])) {
            return 3; // Medio comfort level
        } else {
            return 1; // Bajo comfort level
        }
    }

    protected $appends = ['comfort_level'];
}
