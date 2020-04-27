<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking_detail extends Model
{
    public function Booking()
    {
        return $this->belongsTo('App\Model\Booking','booking_id','id');
    }

    public function Room()
    {
        return $this->belongsTo('App\Model\Room','room_id','id');
    }
}
