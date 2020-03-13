<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'link', 'is_active', 'parent_id', 'icon', 'sort_id'
    ];

    public function subCategory(){
        return $this->hasMany('App\Category', 'parent_id');
    }
}
