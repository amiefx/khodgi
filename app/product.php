<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'isActive',
        'price_pkr',
        'price_usd',
        'price_aud',
        'price_eur',
        'price_gbp',
        'special_price_percentage',
        'special_price_start',
        'special_price_end',
        'image1',
        'image2',
        'image3',
        'image4',
        'new_from',
        'new_to',
    ];
}
