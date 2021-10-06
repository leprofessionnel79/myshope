@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products  <a href="{{route('new-product')}}"><i class="fas fa-plus-circle"></i></a></div>

                <div class="card-body">
                  <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-4">
                      <div class="alert alert-primary" role="alert">
                        <h5>title :{{$product->title}} </h5>
                        <p>category : {{$product->category->name}}</p>
                        <p>price : {{$currency}}{{$product->price}}</p>
                        {!!(count($product->images))>1?'<img class="img-thumbnail card-img" src="'.$product->images[0]->url.'"/>':''!!}

                        <a href="{{route('update-product',['id'=>$product->id])}}" class="btn btn-success mt-3">Update Product</a>

                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{$products->links()}}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
