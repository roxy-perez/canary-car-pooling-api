<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'car_registration_number',
        'car_color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function rides()
    {
        return $this->hasMany(Ride::class);
    }
}
