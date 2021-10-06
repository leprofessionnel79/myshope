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
                    <form action="{{route('update-product')}}" method="post" class="row">
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


                       {{-- options section --}}
                       <div class="form-group col-md-12" >
                            <table class="table table-striped" id="option-table">

                            </table>
                            <a href="#" class="btn btn-primary" id="add-option"> Add Option</a>
                       </div>


                       {{-- /options section --}}
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal options_window" tabindex="-1" role="dialog" id="options_window">

        <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">
            <h5 class="modal-title">Add Option</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body row">


                <div class="form-group col-md-6 " >
                <label for="option_name" >Option Name</label>
                <input type="text" class="form-control" id="option_name" name="option_name" placeholder="Option Name" required>
                </div>

                <div class="form-group col-md-6 " >
                    <label for="option_option" >Option</label>
                    <input type="text" class="form-control" id="option_option" name="option_option" placeholder="Option Option" required>
                    </div>


            <p id="edit_message"></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn btn-primary " id="option-button">Add Option</button>
            </div>

        </div>

        </div>

</div>

@endsection


@section('scripts')

   <script>
      jQuery(document).ready(function(){
        //   alert('hi');
         var $optionWindow = $('#options_window');
         var $optionButton = $('#add-option');

         $optionButton.on('click',function(e){
            e.preventDefault();

            $optionWindow.modal('show');
         });

         $(document).on('click','.remove_option',function(e){
              e.preventDefault();
              $(this).parent().parent().remove();
         });

         $(document).on('click','#option-button',function(e){
            e.preventDefault();
            var $optionName = $('#option_name');
            var $optionOption = $('#option_option');
            var $table = $('#option-table');

            if($optionName.val() ==='')
            {
                alert('option name is required');
                false;
            }

            if($optionOption.val() ==='')
            {
                alert('option option is required');
                false;
            }

            var optionrow = `
               <tr>
                        <td>
                           `+$optionName.val()+`
                        </td>
                        <td>
                            `+$optionOption.val()+`
                        </td>
                        <td>
                            <a href="#" class="remove_option"><i class="fas fa-minus-circle"></i></a>
                            <input type="hidden" name="`+$optionName.val()+`[]" value=" `+$optionOption.val()+`">
                        </td>
               </tr>

            `;

            $table.append(optionrow);
            $optionOption.val('');
         });
      });
   </script>

@endsection
