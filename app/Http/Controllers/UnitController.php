<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

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

    return redirect()->back();
}
}
