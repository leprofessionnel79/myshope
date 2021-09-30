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
}
