@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Reviews</div>

                <div class="card-body">
                  <div class="row">
                    @foreach ($reviews as $review)
                    <div class="col-md-3">
                      <div class="alert alert-primary" role="alert">
                        <p>{{$review->customer->formattedName()}}</p>
                        <p>product : {{$review->product->title}}</p>
                        <p>stars :
                            @php
                                $stars= 5;
                                $emptystar= $stars-$review->stars;
                            @endphp
                            @for ($i = 0; $i < $review->stars; $i++)
                            <i class="fas fa-star"></i>

                            @endfor
                            @for ($i = 0; $i < $emptystar; $i++)
                            <i class="far fa-star"></i>

                            @endfor
                        </p>
                        <p>review : {{$review->review}}</p>
                        <p>date : {{$review->formattedTime()}}</p>
                      </div>
                    </div>
                  @endforeach
                  </div>

                  {{$reviews->links()}}


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
