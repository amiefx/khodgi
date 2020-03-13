<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
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
            'link' => $this->link,
            'is_active' => $this->is_active,
            'parent_id' => $this->parent_id,
            'icon' => $this->icon,
            'sort_id' => $this->sort_id,
            'created_at' => $this->created_at->format('Y-M-D H:i:s')
        ];
    }
}
