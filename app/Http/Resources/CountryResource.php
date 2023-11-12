<?php

namespace App\Http\Resources;

use App\Http\Resources\Products\VariantValueResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data=[
            'id'=> $this->id,
            'name_en'=> $this->name_en,
            'name_ar'=> $this->name_ar,
            'description_en'=> $this->description_en,
            'description_ar'=> $this->description_ar,
            'logs' => CountryLogResource::collection($this->whenLoaded('logs')),
        ];
        return $data;
    }
}
