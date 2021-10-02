@extends('layouts.app')

@section('content')

@if (session()->has('message'))

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fa fa-check-circle ml-50"></i>    {{session()->get('message')}}</strong>
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
                    <form action="{{route('units')}}" method="post" class="row">
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
                          <span>
                            <form action="{{route('units')}}" method="post">
                              @csrf
                              <input type="hidden" value="delete" name="_method">
                              <input type="hidden"  name="unit_id" value="{{$unit->id}}">
                              <button type="submit" class="delete-btn" style="appearance: none;
                              background: none;
                              color: red;
                              position: absolute;
                              right: 10px;
                              border: none;"><i class="fas fa-trash-alt"></i></button>
                            </form>
                          </span>
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

@endsection








