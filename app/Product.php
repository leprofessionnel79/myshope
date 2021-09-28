<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'title','description','unit',
        'price','total'
    ];

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function reviews(){
        return $this->HasMany(Review::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
