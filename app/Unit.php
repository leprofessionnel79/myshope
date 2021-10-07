<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $primarykey ='id';
    protected $table = 'units';
    protected $fillable=['unit_code','unit_name'];


    public function products (){
        return $this->HasMany(Product::class);
    }

    public function formatted (){
        return $this->unit_name.' - '.$this->unit_code;
    }
}


