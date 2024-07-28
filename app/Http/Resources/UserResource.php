<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'full_name' => $this->full_name,
            'email' => $this->email,
            'contact_number' => $this->contact_number,
            'profile_picture' => $this->profile_picture,
            'driving_license_number' => $this->driving_license_number,
            'driving_license_valid_from' => $this->driving_license_valid_from,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
