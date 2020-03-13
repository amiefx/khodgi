<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Attribute_set extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'sort_id' => $this->sort_id,
            'created_at' => $this->created_at->format('Y-N-D H:i:s')
        ];
    }
}
