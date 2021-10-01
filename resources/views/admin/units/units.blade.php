@extends('layouts.app')

@section('content')

@if (Session::has('message'))

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fa fa-check-circle ml-50"></i>Success  {{Session::get('message')}}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>



@endif









<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Units</div>

                <div class="card-body">
                    <form action="" method="post" class="row">
                         @csrf
                        <div class="form-group col-md-6" >
                            <label for="unit_name">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
                          </div>
                          <div class="form-group col-md-6" >
                            <label for="unit_code">Unit Code</label>
                            <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required>
                          </div>
                          <div class="form-group col-md-12" >
                            <button class="btn btn-primary" type="submit">Save new Unit</button>
                          </div>

                    </form>


                  <div class="row">
                    @foreach ($units as $unit)
                    <div class="col-md-3">
                      <div class="alert alert-primary" role="alert">
                        <p>{{$unit->unit_name}}, {{$unit->unit_code}} </p>

                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{$units->links()}}


                </div>
            </div>
        </div>
    </div>
</div>


{{-- <div class="toast" style="position: absolute; top: 10%; right: 10%;">
    <div class="toast-header">

    <strong class="mr-auto">Bootstrap</strong>

    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <div class="toast-body">
    @if (Session::has('message'))

        {{Session::get('message')}}

    @endif
    </div>
</div> --}}


@endsection

@section('scripts')


            <script>

            jQuery(document).ready(function($){
               // alert('hi');
                // $('.toast').toast('show');
            });

            </script>



@endsection






