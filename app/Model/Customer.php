<?php

namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    protected $table = 'customers';
    protected $fillable = [
        'email', 'password'
    ];
    public function role()
    {
        return $this->belongsTo('App\Model\Role','role_id','id');
    }

    public function booking()
    {
        return $this->hasMany('App\Model\Booking', 'customer_id','id');
    }
    public function comment()
    {
        return $this->hasMany('App\Model\Comment','id_customer','id');
    }
}
