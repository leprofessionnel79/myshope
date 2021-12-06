@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tags</div>

                <div class="card-body">
                    <form action="{{route('tags')}}" method="post" class="row">
                        @csrf
                        <div class="form-group col-md-6" >
                           <label for="tag">Tag Name</label>
                           <input type="text" class="form-control" id="tag" name="tag" placeholder="tag" required>
                         </div>

                         <div class="form-group col-md-12" >
                            <button class="btn btn-primary" type="submit">Save Tag</button>
                        </div>

                   </form>
                  <div class="row">
                    @foreach ($tags as $tag)
                    <div class="col-md-3">
                      <div class="alert alert-primary" role="alert">
                        <span class="btn-span">
                            <span><a  class="edit_tag" data-tagid="{{$tag->id}}"
                              data-tag="{{$tag->tag}}"
                               ><i class="fas fa-edit"></i></a></span>

                            <span><a  class="delete_tag" data-tagid="{{$tag->id}}" data-tag="{{$tag->tag}}"
                                 ><i class="far fa-trash-alt"></i></a></span>
                        </span>

                        <p>Tag :{{$tag->tag}} </p>

                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{-- {{$tags->links()}} --}}

                  {{ (!is_null($showLinks) && $showLinks) ? $tags->links():'' }}

                  <form action="{{route('tags-search')}}" method="get">
                      @csrf
                     <div class="row">

                            <div class="form-group col-md-6" >
                              <input type="text" class="form-control" id="search_tags" name="search_tags" placeholder="Search Tags" required>
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

    <div class="modal delete_window" tabindex="-1" role="dialog" id="delete-window">
        <div class="modal-dialog" role="document">
        <div class="modal-content col-md-9">
            <div class="modal-header">
            <h5 class="modal-title">Delete Tag</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <form action="{{route('tags')}}" method="post">
                <div class="modal-body">
                <p id="delete-message"></p>

                    @csrf
                    <input type="hidden" value="delete" name="_method">
                    <input type="hidden"  name="tag_id" value="" id="tag_id">
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
                <button type="submit" class="btn btn-primary">DELETE</button>
                </div>
        </form>
        </div>
        </div>
    </div>




  <div class="modal edit_window" tabindex="-1" role="dialog" id="edit-window">
    <form action="{{route('tags')}}" method="post" >
        <div class="modal-dialog" role="document">

        <div class="modal-content col-md-9">

            <div class="modal-header">
            <h5 class="modal-title">Update Tag</h5>



            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">

                @csrf
                <div class="form-group col-md-6" >
                <label for="edit_unit_name" >Tag Name</label>
                <input type="text" class="form-control" id="edit_tag_tag" name="tag_tag" placeholder="Tag Name" required>
                </div>

                <input type="hidden"  name="tag_id" value="" id="edit_tag_id">
                <input type="hidden" name="_method" value="put">
            <p id="edit_message"></p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
            <button type="submit" class="btn btn-primary">UPDATE</button>
            </div>

        </div>

        </div>
    </form>
</div>

@section('scripts')




  <script>

    $(document).ready(function(){
       // alert('hi');
      var $deleteTag=$('.delete_tag');
      var $deleteWindow=$('#delete-window');
      var $tagId = $('#tag_id');

      var $edittagId = $('#edit_tag_id');

      var $deletemessage=$('#delete-message');




      $deleteTag.on('click',function(element){
        element.preventDefault();
      var tag_id = $(this).data('tagid');
      var tag_tag = $(this).data('tag');

       $tagId.val(tag_id);
       $deletemessage.text('are you sure u want delete '+tag_tag+' ?');
        $deleteWindow.modal('show');
      });

      var $editmessage=$('#edit_message');
      var $editWindow=$('#edit-window');

      var $editTag=$('.edit_tag');


      var $editTagTag=$('#edit_tag_tag');
      var $editTagId=$('#edit_tag_id');

      $editTag.on('click',function(element){
        element.preventDefault();
      var tag_id = $(this).data('tagid');
      var tag_tag = $(this).data('tag');


      $editTagTag.val(tag_tag);

      $editTagId.val(tag_id);

      //$editunitId.val(unit_id);
      //$editmessage.text('the unit '+$editUnitName+' with code name '+$editUnitCode+' has been updated');
        $editWindow.modal('show');
      });


    });

</script>

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

