<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_size extends Model
{
    protected $fillable = [
        'product_id',
        'attribute_sets_id',
        'attributes_id',
        'xs',
        's',
        'm',
        'l',
        'xl',
    ];
}
