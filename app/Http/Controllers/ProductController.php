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

    public function update(Request $request){
          //dd($request);
    }

    public function store(Request $request){
        //dd($request);
        $request->validate([
           'product_title'=>'required',
           'product_description'=>'required',
           'product_category'=>'required',
           'product_unit'=>'required',
           'product_price'=>'required',
           'product_discount'=>'required',
           'product_total'=>'required',

        ]);



        $product=new Product();
        $product->title=$request->input('product_title');
        $product->description=$request->input('product_description');
        $product->category_id=intval($request->input('product_category'));
        $product->unit=$request->input('product_unit');
        $product->price=doubleval($request->input('product_price'));
        $product->discount=doubleval($request->input('product_discount'));
        $product->total=doubleval($request->input('product_total'));


        

        if($request->has('options')){
            $optionArray=[];
            $options=array_unique($request->input('options'));
            foreach($options as $option){
             $actualOptions = $request->input($option);
             $optionArray[$option]=[];
                foreach($actualOptions as $actualoption){
                array_push($optionArray[$option],$actualoption);
                }
            }

            $product->options=json_encode($optionArray);
        }




        $product->save();

        return redirect(route('products'));
  }
}
