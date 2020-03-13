<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Attribute extends JsonResource
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
            'attribute_sets_id' => $this->attribute_sets_id,
            'attribute_set' => $this->attributeSet->name,
            'sort_id' => $this->sort_id,
            'created_at' => $this->created_at->format('Y-N-D H:i:s')
        ];
    }
}
