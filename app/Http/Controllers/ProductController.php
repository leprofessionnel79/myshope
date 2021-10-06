<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products=Product::with(['category','images'])->paginate(env('NUMBER_OF_PAGES'));
        $currency=env('SHOP_CURRENCY',"$");
        return view('admin.products.products')->with([
            'products'=>$products,
            'currency'=>$currency,
        ]);
    }

    public function newProduct($id=null){
        $product=null;
        if(!is_null($id)){
            $product=Product::with(['hasUnit'])->find($id);
        }

        $categories=Category::all();
        $units=Unit::all();
        return view('admin.products.new-product')->with([
            'product'=>$product,
            'units'=>$units,
            'categories'=>$categories
        ]);
    }
}
