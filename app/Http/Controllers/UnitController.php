<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    public function search(Request $request){
        $request->validate([
            'search_units'=>'required'
        ]);

        $searchTerms = $request->input('search_units');


        $units = Unit::where('unit_name','LIKE','%'.$searchTerms.'%')->orwhere(
            'unit_code','LIKE','%'.$searchTerms.'%'
        )->get();

        if (count($units)==0){
            return redirect()->back()->with([
                'message'=>'unit dosnt exist'
            ]);
        }

        if (count($units)>0){
            return view('admin.units.units')->with([
                'units'=>$units,
                'showLinks'=>false,
            ]);
        }

    }


    public function showAdd(){
         return view('admin.units.add_edit');
    }

    public function index(){
        $units=Unit::paginate(env('NUMBER_OF_PAGES'));
        return view('admin.units.units')->with([

            'units'=>$units,
            'showLinks'=>true,
        ]);
   }

   private function unitNameExist($unitName){
       $unit=Unit::where('unit_name','=',$unitName)->first();
       if(is_null($unit)){
        Session::flash('message', 'The unit ('.$unitName.') dosnt exist');
        return false;
       }

       return true;
   }

   private function unitCodeExist($unitCode){
    $unit=Unit::where('unit_code','=',$unitCode)->first();
    if(is_null($unit)){
     Session::flash('message', 'The unit ('.$unitCode.') dosnt exist');
     return false;
    }

    return true;
}

   public function store(Request $request){

    $request->validate([
        'unit_name'=>'required',
        'unit_code'=>'required'
    ]);

    $unitName = $request->input('unit_name');
    $unitCode =  $request->input('unit_code');
    $unit=new Unit();
    $unit->unit_name=$request->input('unit_name');
    $unit->unit_code=$request->input('unit_code');

    $unit->save();


    return redirect()->back()->with([
        'message'=>'unit '.$unit->unit_name.' has added'
    ]);
}

    public function delete(Request $request){

        if(is_null($request->input('unit_id')) || empty($request->input('unit_id'))){
            return redirect()->back()->with([
                'message'=>'Unit ID is Required'
            ]);
        }
        $id =$request->input('unit_id');
        Unit::destroy($id);


        return redirect()->back()->with([
            'message'=>'unit has been deleted'
        ]);
    }

    public function update (Request $request){

        // dd($request);
        $request->validate([
           'unit_name'=>'required',
           'unit_code'=>'required',
           'unit_id'=>'required'
        ]);

        $unitName = $request->input('unit_name');
        $unitCode =  $request->input('unit_code');



        $unitid = intval($request->input('unit_id'));
        $unit = Unit::find($unitid);

        $unit->unit_name=$request->input('unit_name');
        $unit->unit_code=$request->input('unit_code');

        $unit->save();
        return redirect()->back()->with([
           'message'=>'Unit has been Updated successfully'
        ]);
    }
}
