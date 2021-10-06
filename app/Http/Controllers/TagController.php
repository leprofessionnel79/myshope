<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TagController extends Controller
{
    public function index(){
        $tags=Tag::paginate(env('NUMBER_OF_PAGES'));
        return view('admin.tags.tags')->with([
            'tags'=>$tags,
            'showLinks'=>true,
        ]);
    }

    private function tagNotExists($tagname){
        $tag=Tag::where('tag','=',$tagname)->first();
        if(is_null($tag)){
         Session::flash('message', 'The tag ('.$tagname.') dosnt exist');
         return true;
        }

        return false;
    }

    public function search(Request $request){
        $request->validate([
            'search_tags'=>'required'
        ]);

        $searchTerms = $request->input('search_tags');

        $tags = Tag::where('tag','LIKE','%'.$searchTerms.'%')->get();

        if (count($tags)==0){
            return redirect()->back()->with([
                'message'=>'tag dosnt exist'
            ]);
        }

        if (count($tags)>0){
            return view('admin.tags.tags')->with([
                'tags'=>$tags,
                'showLinks'=>false,
            ]);
        }


    }


    public function store (Request $request){
        $request->validate([
           'tag'=>'required',
        ]);
        $tag = $request->input('tag');
        $tags=Tag::where('tag','=',$tag)->get();

        if(count($tags)>0){
            return redirect()->back()->with([
                'message'=>'tag name already exists'
            ]);
        }

        $newTag=new Tag();
        $newTag->tag=$request->input('tag');
        $newTag->save();

        return redirect()->back()->with([
            'message'=>'tag '.$newTag->tag.' has been added '
        ]);

    }

    public function delete(Request $request){

        if(is_null($request->input('tag_id')) || empty($request->input('tag_id'))){
            return redirect()->back()->with([
                'message'=>'Tag ID is Required'
            ]);
        }
        $id =$request->input('tag_id');
        Tag::destroy($id);

        return back()->with([
            'message'=>'tag has been deleted',

        ]);
    }

    public function update (Request $request){

        $request->validate([
           'tag_tag'=>'required',
           'tag_id'=>'required'
        ]);

        $tagid = intval($request->input('tag_id'));
        $tag = Tag::find($tagid);

        $tag->tag=$request->input('tag_tag');
        $tag->save();
        return back()->with([
           'message'=>'Tag has been Updated successfully'
        ]);
    }
}
