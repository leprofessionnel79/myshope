@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Countries</div>

                <div class="card-body">
                  <div class="row">
                    @foreach ($countries as $country)
                    <div class="col-md-3">
                      <div class="alert alert-primary" role="alert">
                        <p>{{$country->name}} </p>
                        <p> currency : {{$country->currency}} </p>
                        <p>capital : {{$country->capital}} </p>

                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{$countries->links()}}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
