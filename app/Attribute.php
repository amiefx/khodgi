<?php

namespace App;
use App\Attribute_set;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'name',
        'attribute_sets_id',
        'sort_id'
    ];

    public function attributeSet(){
        return $this->belongsTo(Attribute_set::class);
    }
}
