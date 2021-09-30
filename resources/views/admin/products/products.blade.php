@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products</div>

                <div class="card-body">
                  <div class="row">
                    @foreach ($products as $product)
                    <div class="col-md-6">
                      <div class="alert alert-primary" role="alert">
                        <h5>title :{{$product->title}} </h5>
                        <p>category : {{$product->category->name}}</p>
                        {!!(count($product->images))>1?'<img class="img-thumbnail card-img" src="'.$product->images[0]->url.'"/>':''!!}

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
