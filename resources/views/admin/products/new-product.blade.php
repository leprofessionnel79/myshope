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
                    <form action="{{route('new-product')}}" method="post">
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
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
