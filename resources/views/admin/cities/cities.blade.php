@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Cities</div>

                <div class="card-body">
                  <div class="row">
                    @foreach ($cities as $city)
                    <div class="col-md-3">
                      <div class="alert alert-primary" role="alert">
                        <p>{{$city->name}} </p>
                        <p> country : {{$city->country->name}} </p>
                        <p> state : {{$city->state->name}} </p>

                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{$cities->links()}}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
