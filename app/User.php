<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password','email_verified','mobile',
        'mobile_verified','shipping_address','billing_address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }

    public function shipments(){
        return $this->hasMany(Shipment::class);
    }

    public function shippingAddress(){
        return $this->hasOne(Address::class,'shipping_address','id');
    }

    public function billingAddress(){
        return $this->hasOne(Address::class,'billing_address','id');
    }
}
