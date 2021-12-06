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
                    <form action="{{(!is_null($product))?route('update-product'):route('new-product')}}" method="post" class="row" enctype="multipart/form-data">
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
                            <textarea type="text" class="form-control" id="product_description" name="product_description" required
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
                            <select name="product_unit" id="product_unit" class="form-control" required>
                                <option>Select Unit</option>
                                @foreach ($units as $unit )

                                <option value="{{$unit->id}}"
                                    {{(!is_null($product) && ($product->hasUnit->id===$unit->id))?'selected':''}}> {{$unit->formatted()}}</option>

                                @endforeach
                            </select>
                       </div>

                       <div class="form-group col-md-6" >
                        <label for="product_price">Product Price</label>
                        <input type="number" class="form-control" id="product_price" name="product_price"  placeholder="Product Price" step="any" required
                        value="{{(!is_null($product))? $product->price:''}}" >
                       </div>

                       <div class="form-group col-md-6" >
                        <label for="product_discount">Product Discount</label>
                        <input type="number" class="form-control" id="product_discount" name="product_discount" step="any" placeholder="Product Discount" required
                        value="{{(!is_null($product))? $product->discount:'0'}}" >
                       </div>

                       <div class="form-group col-md-12" >
                        <label for="product_total">Product Total</label>
                        <input type="number" class="form-control" id="product_total" name="product_total" step="any" placeholder="Product Total" required
                        value="{{(!is_null($product))? $product->total:''}}" >
                       </div>


                       {{-- options section --}}
                       <div class="form-group col-md-12" >
                            <table class="table table-striped" id="option-table">

                                @if (!is_null($product))

                                  @if (!is_null($product->JsonOptions()))

                                    @foreach ($product->JsonOptions() as $optionNames => $options)

                                       @foreach ($options as $option)

                                            <tr>
                                                    <td>
                                                    {{$optionNames}}
                                                    </td>
                                                    <td>
                                                    {{ $option}}
                                                    </td>
                                                    <td>
                                                        <a href="#" class="remove_option"><i class="fas fa-minus-circle"></i></a>
                                                        <input type="hidden" name="{{$optionNames}}[]" value=" {{$option}}">
                                                    </td>
                                            </tr>
                                       @endforeach
                                       <td><input type="hidden" name="options[]" value="{{$optionNames}}"> </td>

                                    @endforeach

                                  @endif

                                @endif

                            </table>
                            <a href="#" class="btn btn-primary" id="add-option"> Add Option</a>
                       </div>


                       {{-- /options section --}}

                       {{-- images section  --}}

                       <div class="form-group col-md-12" >

                            <div class="row">
                               @for ($i=0;$i<6;$i++)
                                    <div class="col-md-4 col-sm-12 mb-4">

                                        <div class="card card-image-upload" >


                                            @if (!is_null($product)&& !is_null($product->images)&& count($product->images)>0)
                                                @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                <a href="" class="remove-image-upload" data-imageid="{{$product->images[$i]->id}}" data-fileid="image-{{$i}}" data-removeimg="removeimg-{{$i}}"><i class="fas fa-minus-circle"></i></a>
                                                @else
                                                <a href="" class="remove-image-upload" style="display: none"><i class="fas fa-minus-circle"></i></a>
                                                @endif
                                            @else
                                            <a href="" class="remove-image-upload" style="display: none"><i class="fas fa-minus-circle"></i></a>

                                            @endif
                                            {{-- <a href="" class="remove-image-upload"><i class="fas fa-minus-circle"></i></a> --}}
                                            <a href="#" class="activate-image-upload" data-fileid="image-{{$i}}" id="removeimg-{{$i}}">
                                                @if (!is_null($product)&& !is_null($product->images)&& count($product->images)>0)
                                                  @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                  <img id="{{'iimage-'.$i}}" src="{{asset($product->images[$i]->url)}}" class="card-img-top">

                                                  @endif

                                                @endif
                                                <div class="card-body" style="text-align: center">
                                                @if (!is_null($product)&& !is_null($product->images)&& count($product->images)>0)
                                                        @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                        <i style ="display: none;" class="fas fa-image"></i>
                                                        @else
                                                        <i class="fas fa-image"></i>
                                                        @endif

                                                @else
                                                  <i class="fas fa-image"></i>
                                                @endif

                                                </div>
                                            </a>
                                            @if (!is_null($product)&& !is_null($product->images)&& count($product->images)>0)
                                                  @if (isset($product->images[$i]) && !is_null($product->images[$i]) && !empty($product->images[$i]))
                                                  <input name="product_images[]" type="file" class="form-control-file file-image-upload" id="image-{{$i}}" value="{{asset($product->images[$i]->url)}}">
                                                  @else
                                                  <input name="product_images[]" type="file" class="form-control-file file-image-upload" id="image-{{$i}}">

                                                  @endif

                                            @else
                                            <input name="product_images[]" type="file" class="form-control-file file-image-upload" id="image-{{$i}}">

                                            @endif


                                        </div>


                                    </div>
                                @endfor
                            </div>
                       </div>


                          {{-- /images section  --}}

                       <div class="form-group col-md-6 offset-md-3" >
                          <button type="submit" class="btn btn-primary btn-block">SAVE</button>
                       </div>

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
            <button type="submit" class="btn btn-primary " id="option-button">ADD OPTION</button>
            </div>

        </div>

        </div>

</div>


<div class="modal image_window" tabindex="-1" role="dialog" id="options_window">

    <div class="modal-dialog" role="document">

    <div class="modal-content">

        <div class="modal-header">
        <h5 class="modal-title">DELETE IMAGE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body ">

            <p> Are you sure you want delete this image ?</p>

        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
        <a href="#" class="delete-image-btn btn btn-primary" >DELETE IMAGE</a>
        </div>

    </div>

    </div>

</div>

@endsection


@section('scripts')

    <script>
    var optionNamesList = [];
    </script>

    <script>
    var imageDeletUrl = '{{route('delete-image')}}';
    </script>

    @if (!is_null($product))

      @if (!is_null($product->JsonOptions()))

         @foreach ($product->JsonOptions() as $optionNames => $options)
             <script>optionNamesList.push('{{$optionNames}}');</script>
         @endforeach

      @endif

    @endif

   <script>
      jQuery(document).ready(function(){
        //   alert('hi');
        $.ajaxSetup({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
               });
         var $optionWindow = $('#options_window');
         var $imageWindow = $('.image_window');
         var $optionButton = $('#add-option');

         var optionNamesrow = '';
         var $activateImageUpload = $('.activate-image-upload');

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

            if(!optionNamesList.includes($optionName.val())){

                optionNamesList.push($optionName.val());
                optionNamesrow='<input type="hidden" name="options[]" value=" '+$optionName.val()+'">'
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
            $table.append(optionNamesrow);
            $optionOption.val('');
         });

        function readURL(input , imageID) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                      $('#'+imageID).attr('src', e.target.result);
                    // $(input).after($img);
                    //console.log(e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetUploadFile(fileUploadId,imageID,$ei,$ed){
           $('#'+imageID).attr('src','');
           $ei.fadeIn();
           if($ed!=null){
            $ed.fadeOut();
           }

           $('#'+fileUploadId).val('');
        }

         $activateImageUpload.on('click',function(e){
             e.preventDefault();
            var fileUploadId=$(this).data('fileid');
            var me=$(this);
            $('#'+fileUploadId).trigger('click');
            var imagetag = '<img id="i'+fileUploadId+'" src="" class="card-img-top">';
            $(this).append(imagetag);

            $('#'+fileUploadId).on('change',function(e){
             readURL(this,'i'+fileUploadId);
             me.find('i').fadeOut();
             var $removeimage=me.parent().find('.remove-image-upload');
             $removeimage.fadeIn();

             $removeimage.on('click',function(e){
                 e.preventDefault();
                 resetUploadFile('#'+fileUploadId,'i'+fileUploadId,me.find('i'),$removeimage);
             });
            });
         });
         $('.remove-image-upload').on('click',function(e){
            e.preventDefault();
            var me = $(this);
            var imageID = me.data('imageid');
            var fileUploadId=$(this).data('fileid');
            var $removeimage=me.parent().find('.remove-image-upload');
            var removeID = $(this).data('removeimg');

            $('.delete-image-btn').data('ed',$removeimage);
            $('.delete-image-btn').data('fileid',fileUploadId);
            $('.delete-image-btn').data('removeimg',removeID);
            $('.delete-image-btn').data('imageid',imageID);
            $imageWindow.modal('show');



            $(document).on('click','.delete-image-btn',function(e){
               e.preventDefault();
               var imageID = $(this).data('imageid');
               var fileUploadId = $(this).data('fileid');
               var removeID = $(this).data('removeimg');
               var ed = $(this).data('ed');
               resetUploadFile(fileUploadId,'i'+fileUploadId,$('#'+removeID).find('i'),ed);

               $.ajax({
                    url:imageDeletUrl,
                    data:{
                        image_id:imageID
                    },
                    dataType:'json',
                    method:'post',
              });

              $imageWindow.modal('hide');
            });
         });
      });
   </script>

@endsection
