<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Product extends JsonResource
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
            // 'id' => $this->id,
            // 'name' => $this->name,
            // 'email' => $this->email,
            // 'role' => $this->role->name,
            // 'photo' => asset('storage/' . $this->profile->photo),
            // 'created_at' => $this->created_at->format('Y-N-D H:i:s')
            'id' => $this->id,
            'name' => $this->name,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'isActive' => $this->isActive,
            'price_pkr' => $this->price_pkr,
            'price_usd' => $this->price_usd,
            'price_aud' => $this->price_aud,
            'price_eur' => $this->price_eur,
            'price_gbp' => $this->price_gbp,
            'special_price_percentage' => $this->special_price_percentage,
            'special_price_start' => $this->special_price_start,
            'special_price_end' => $this->special_price_end,
            'image1' => $this->image1,
            'image2' => $this->image2,
            'image3' => $this->image3,
            'image4' => $this->image4,
            'new_from' => $this->new_from,
            'new_to' => $this->new_to,
            'product_sizes' => $this->product_sizes,
            'created_at' => $this->created_at->format('Y-M-D H:i:s')
        ];
    }
}
