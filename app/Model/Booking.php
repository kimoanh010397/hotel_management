<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function customer()
    {
        return $this->belongsTo('App\Model\Customer','customer_id','id');
    }

    public function booking_detail()
    {
        return $this->hasMany('App\Model\Booking_detail', 'booking_id','id');
    }
}
