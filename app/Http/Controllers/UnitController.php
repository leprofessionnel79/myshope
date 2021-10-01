<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    public function showAdd(){
         return view('admin.units.add_edit');
    }

    public function index(){
        $units=Unit::paginate(16);
        return view('admin.units.units')->with(['units'=>$units]);
   }

   public function store(Request $request){

    $request->validate([
        'unit_name'=>'required',
        'unit_code'=>'required'
    ]);

    $unit=new Unit();
    $unit->unit_name=$request->input('unit_name');
    $unit->unit_code=$request->input('unit_code');

    $unit->save();

    Session::flash('message','unit '.$unit->unit_name.' has added');

    return redirect()->back();
}
}
