<?php

namespace App\Http\Resources;

use App\Enum\LogTypeEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CountryLogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data=['update_type'=>LogTypeEnum::from($this->type)->name,'updated_data'=>[]];
        foreach ($this->new_data as $key=>$value)
        {
            if (isset($this->old_data[$key]))
            {
                if ($this->old_data[$key] != $value)
                {
                    $data['updated_data'][$key]['old']=$this->new_data[$key];
                    $data['updated_data'][$key]['new']=$value;
                }
            }

        }
        return $data;
    }
}
