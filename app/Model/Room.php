<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function booking_detail()
    {
        return $this->hasMany('App\Model\Booking_detail', 'room_id','id');
    }

    public function slider()
    {
        return $this->hasMany('App\Model\Slider', 'room_id','id');
    }
    public  function comment(){
        return $this->hasMany('App\Model\Comment','comment_id','id');
    }
}
