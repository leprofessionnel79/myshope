<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products=Product::with(['category','images'])->paginate(env('NUMBER_OF_PAGES'));
        return view('admin.products.products')->with([
            'products'=>$products
        ]);
    }
}
