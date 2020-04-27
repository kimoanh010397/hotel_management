<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Model\Room','room_id','id');
    }
}
