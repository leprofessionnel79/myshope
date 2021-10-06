@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">

                    {!!(!is_null($product))?'Update Product   <span class="update-product"> '.$product->title.'</span>':'New Product'!!}
                </div>

                <div class="card-body">
                    <form action="{{route('new-product')}}" method="post" class="row">
                       @csrf

                       @if (!is_null($product))

                       <input type="hidden"  name="prduct_id" value="{{$product->id}}" id="prduct_id">
                       <input type="hidden" name="_method" value="put">

                       @endif

                       <div class="form-group col-md-12" >
                            <label for="product_title">Product Title</label>
                            <input type="text" class="form-control" id="product_title" name="product_title"
                            value="{{(!is_null($product))? $product->title:''}}"  placeholder="Product Title" required>
                       </div>

                       <div class="form-group col-md-12" >
                            <label for="product_title">Product Description</label>
                            <textarea type="text" class="form-control" id="product_description" name="product_description"
                            placeholder="product_description" requiredcols="30" rows="10">{{(!is_null($product))? $product->description:''}}</textarea>
                       </div>

                       <div class="form-group col-md-12" >
                        <label for="product_category">Product Category</label>
                        <select name="product_category" id="product_category" class="form-control" required>
                            <option>Select Category</option>
                            @foreach ($categories as $category )

                            <option value="{{$category->id}}"
                                {{(!is_null($product) && ($product->category->id===$category->id))?'selected':''}}> {{$category->name}}</option>

                            @endforeach
                        </select>
                       </div>

                       <div class="form-group col-md-12" >
                            <label for="product_unit">Product Unit</label>
                            <select name="prduct_unit" id="prduct_unit" class="form-control" required>
                                <option>Select Unit</option>
                                @foreach ($units as $unit )

                                <option value="{{$unit->id}}"
                                    {{(!is_null($product) && ($product->hasUnit->id===$unit->id))?'selected':''}}> {{$unit->formatted()}}</option>

                                @endforeach
                            </select>
                       </div>

                       <div class="form-group col-md-6" >
                        <label for="product_price">Product Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price"  placeholder="Product Price" required
                        value="{{(!is_null($product))? $product->price:''}}" >
                       </div>

                       <div class="form-group col-md-6" >
                        <label for="product_discount">Product Discount</label>
                        <input type="number" class="form-control" id="product_discount" name="product_discount"  placeholder="Product Discount" required
                        value="{{(!is_null($product))? $product->discount:'0'}}" >
                       </div>

                       <div class="form-group col-md-12" >
                        <label for="product_total">Product Total</label>
                        <input type="number" class="form-control" id="product_total" name="product_total"  placeholder="Product Total" required
                        value="{{(!is_null($product))? $product->total:''}}" >
                       </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
