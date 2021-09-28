<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $primarykey ='id';
    protected $table ='countries';

    public function cities(){
        return $this->hasMany(City::class);
    }

    public function states(){
        return $this->hasMany(State::class);
    }
}
