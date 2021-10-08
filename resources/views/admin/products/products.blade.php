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
                        {!!(count($product->images))>0?'<img class="img-thumbnail card-img" src="'.$product->images[0]->url.'"/>':''!!}


                        {{-- @if (!is_null($product->options))

                            @foreach ($product->JsonOptions() as $key => $values)
                                <div class="form-group col-md-12" >
                                    <label for="{{$key}}">{{$key}}</label>
                                    <select  class="form-control" id="{{$key}}" name="{{$key}}"
                                    value="{{$key}}" >
                                        @foreach ($values as $value)
                                            <option value="{{$value}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            @endforeach

                        @endif --}}



                        <a href="{{route('new-product',['id'=>$product->id])}}" class="btn btn-success mt-3">Update Product</a>

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

 <div class="toast" style="position: absolute; top: 10%; right: 10%;">
    <div class="toast-header">

      <strong class="mr-auto">Tag</strong>

      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      @if (session()->has('message'))
         {{session()->get('message')}}
      @endif
    </div>
  </div>

@endsection

@section('scripts')

        @if (session()->has("message"))

            <script>
                $(document).ready(function(){
                    $toast = $('.toast').toast({
                    autohide: false
                    });

                    $toast.toast('show');
                });
            </script>

        @endif

@endsection
