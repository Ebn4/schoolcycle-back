<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
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
            'title' => $this->description,
            'operation_type' => $this->operation_type,
            'school_level' => $this->school_level,
            'is_completed' => $this->is_completed,
            'is_canceled' => $this->is_canceled,
            'price' => $this->price,
            'state' => $this->state,
            'exchange_location' => $this->exchange_location,
            'exchange_location_lat' => $this->exchange_location_lat,
            'exchange_location_logt' => $this->exchange_location_logt,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'category' => new CategoryResource($this->category),
            'author' => new UserResource($this->user),
            'pictures' => PhotoResource::collection($this->photos)

        ];
    }
}
