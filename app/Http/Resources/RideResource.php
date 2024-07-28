<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RideResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_car_id' => $this->user_car_id,
            'created_on' => $this->created_on,
            'travel_start_time' => $this->travel_start_time,
            'source_municipio_id' => $this->source_municipio_id,
            'destination_municipio_id' => $this->destination_municipio_id,
            'seats_offered' => $this->seats_offered,
            'contribution_per_head' => $this->contribution_per_head,
            'luggage_size_id' => $this->luggage_size_id,
            'is_recurring' => $this->is_recurring,
        ];
    }
}
