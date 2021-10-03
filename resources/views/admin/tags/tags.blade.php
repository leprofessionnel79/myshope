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


                        <p>Tag :{{$tag->tag}} </p>

                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{$tags->links()}}


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

  @if (session()->has('message'))

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

