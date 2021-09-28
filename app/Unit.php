<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{

    protected $primarykey ='id';
    protected $table = 'units';
    protected $fillable=['unit_code','unit_name'];


}
