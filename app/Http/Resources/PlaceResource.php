<?php

namespace App\Http\Resources;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'address' => $this->address,
            'phone' => $this->phone,
            'image' => $this->image_Url,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'sub_district' => $this->subDistrict,
            'is_favorit' => Auth::guard('sanctum')->check() ? Auth::guard('sanctum')->user()->places()->pluck('place_id')->contains($this->id) : false,
        ];
    }
}
