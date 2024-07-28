<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRideRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'user_car_id' => 'required|exists:user_cars,id',
      'created_on' => 'required|date',
      'travel_start_time' => 'required|date',
      'source_municipio_id' => 'required|exists:municipios,id',
      'destination_municipio_id' => 'required|exists:municipios,id',
      'seats_offered' => 'required|integer',
      'contribution_per_head' => 'required|integer',
      'luggage_size_id' => 'required|exists:luggage_sizes,id',
      'is_recurring' => 'required|boolean',
    ];
  }
}
