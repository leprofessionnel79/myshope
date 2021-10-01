<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable=['title','message','user_id','order_id','ticket_type_id','status'];

    public function ticketType(){
        return $this->belongsTo(TicketType::class);
    }

    public function customer(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
