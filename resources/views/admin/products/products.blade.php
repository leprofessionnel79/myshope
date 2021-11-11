@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Products  <a href="{{route('new-product')}}" class="new-product"><i title="ADD PRODUCT" class="fas fa-plus-circle"></i></a></div>

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

                            {{-- delete product  --}}
                            <span><a href="#" class="delete_product" data-productname="{{$product->title}}" data-productid="{{$product->id}}"
                                ><i title="DELETE PRODUCT" class="far fa-trash-alt"></i></a></span>




                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{-- {{$products->links()}} --}}

                  {{ (!is_null($showLinks) && $showLinks) ? $products->links():'' }}

                    <form action="{{route('product-search')}}" method="post">
                        @csrf
                        <div class="row">

                                <div class="form-group col-md-6" >
                                    <input type="text" class="form-control" id="search_product" name="search_product" placeholder="Search By Products name or price" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

 <div class="toast" style="position: absolute; top: 10%; right: 10%;">
    <div class="toast-header">

      <strong class="mr-auto">Products</strong>

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


<div class="modal delete_window " tabindex="-1" role="dialog" id="delete-window">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Delete product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    <form action="{{route('products')}}" method="post">
            <div class="modal-body">
            <p id="delete-message"> </p>

                @csrf
                <input type="hidden" value="delete" name="_method">
                <input type="hidden"  name="product_id" value="" id="product_id">
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn btn-primary">DELETE</button>
            </div>
    </form>
      </div>
    </div>
  </div>

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

    <script>
        jQuery(document).ready(function(){

         var $deleteProduct=$('.delete_product');
         var $deleteWindow=$('#delete-window');
         var $productId = $('#product_id');
         var $deletemessage=$('#delete-message');

         $deleteProduct.on('click',function(element){
                 element.preventDefault();
             var product_id = $(this).data('productid');
             var product_name =$(this).data('productname');

             $productId.val(product_id);
             $deletemessage.text('are you sure u want delete product '+product_name+' ?');
                 $deleteWindow.modal('show');

        });
     });

     </script>



@endsection




