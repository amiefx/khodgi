<?php

namespace App;
use App\Attribute;

use Illuminate\Database\Eloquent\Model;

class Attribute_set extends Model
{
    protected $fillable = [
        'name',
        'sort_id'
    ];

    public function attributes(){
        return $this->hasMany(Attribute::class, 'attribute_sets_id' );
    }
}
