<?php

namespace App\Http\Controllers;

use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $reviews=Review::with(['customer','product'])->paginate(env('NUMBER_OF_PAGES'));
        return view('admin.reviews.reviews')->with([
            'reviews'=>$reviews,
        ]);
    }
}
