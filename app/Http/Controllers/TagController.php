<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $tags=Tag::paginate(env('NUMBER_OF_PAGES'));
        return view('admin.tags.tags')->with([
            'tags'=>$tags,
        ]);
    }


    public function store (Request $request){
        $request->validate([
           'tag'=>'required',
        ]);
        $tag = $request->input('tag');
        $tags=Tag::where('tag','=',$tag)->get();

        if(count($tags)>0){
            return redirect()->back()->with([
                'message'=>'tag  already exists'
            ]);
        }

        $newTag=new Tag();
        $newTag->tag=$request->input('tag');
        $newTag->save();

        return redirect()->back()->with([
            'message'=>'tag '.$newTag->tag.' has been added '
        ]);

    }
}
