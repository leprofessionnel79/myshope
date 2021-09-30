<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities=City::with(['state','country'])->paginate(env('NUMBER_OF_PAGES'));
        return view('admin.cities.cities')->with([
            'cities'=>$cities,
        ]);
    }
}
