<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRideRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'user_car_id' => 'sometimes|required|exists:user_cars,id',
      'created_on' => 'sometimes|required|date',
      'travel_start_time' => 'sometimes|required|date',
      'source_municipio_id' => 'sometimes|required|exists:municipios,id',
      'destination_municipio_id' => 'sometimes|required|exists:municipios,id',
      'seats_offered' => 'sometimes|required|integer',
      'contribution_per_head' => 'sometimes|required|integer',
      'luggage_size_id' => 'sometimes|required|exists:luggage_sizes,id',
      'is_recurring' => 'sometimes|required|boolean',
    ];
  }
}
