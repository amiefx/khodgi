<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeSlide extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'link', 'is_active', 'large_image', 'small_image'
    ];
}
