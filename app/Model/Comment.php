<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Comment extends Model
{
    //
    protected $table ='comment';
    protected $fillable = [
        'id_customer', 'id_room', 'content',
    ];
    public function room()
    {
        return $this->hasOne('App\Model\Room','id_room','id');

    }
    public function customer(){
        return $this->belongsTo('App\Model\Customer','id_customer','id');
    }

}
