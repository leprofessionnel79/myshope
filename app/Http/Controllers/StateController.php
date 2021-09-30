<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $states=State::with(['country'])->paginate(env('NUMBER_OF_PAGES'));
        return view('admin.states.states')->with([
            'states'=>$states,
        ]);
    }
}
