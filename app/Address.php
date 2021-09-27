<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable=[
       'street_name','street_number','city',
       'state','post_code','country'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
