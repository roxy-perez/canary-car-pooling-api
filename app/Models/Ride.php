<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_car_id',
        'created_on',
        'travel_start_time',
        'source_municipio_id',
        'destination_municipio_id',
        'seats_offered',
        'contribution_per_head',
        'luggage_size_id',
        'is_recurring',
    ];

    public function userCar()
    {
        return $this->belongsTo(UserCar::class);
    }

    public function sourceMunicipio()
    {
        return $this->belongsTo(Municipio::class, 'source_municipio_id');
    }

    public function destinationMunicipio()
    {
        return $this->belongsTo(Municipio::class, 'destination_municipio_id');
    }
}
