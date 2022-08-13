@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('front.box')
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header">Dishes List</div>

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse($dishes as $dish)
                            <div class="col">
                                <div class="card h-100">

                                    <img src="{{$dish->photo}}" class="card-img-top" alt="photo here">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$dish->name}}</h5>
                                        <h5>Price: {{$dish->price}} €</h5>
                                        <small>Have:
                                            <strong>{{$dish->restaurant->name ?? 'still not Have restorante'}}</strong></small>
                                    </div>
@if(Auth::user()?->role > 0 ?? 0)
                                    <div class="btn-group" role="group">
                                        <form class="btn btn-warning btn-sm " action="{{route('order', Auth::user()->id)}}" method="post">
                                            @csrf
                                            @method('post')
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="count">
                                                <button class="btn btn-outline-secondary btn-sm text-black"
                                                        type="submit">purchase
                                                </button>
                                                <input type="hidden" name="dish_id" value="{{$dish->id}}">
                                            </div>
                                        </form>
                                    </div>


                                    <div class="btn-group " role="group">
                                        <form class="btn btn-secondary btn-sm flex-row"
                                              action="{{route('vote', $dish->id)}}" method="post">
                                            @csrf
                                            @method('put')

                                            @foreach($ratings as $key => $rating)
                                                <div class="form-check form-check-inline mt-1">
                                                    <input class="form-check-input check-color" type="radio" name="vote"
                                                           id="_{{$key + 1}}" value="{{$key + 1}}"
                                                           @if($key + 1 == floor($dish->rating / $dish->count)) checked
                                                           style="border-color: crimson; background-color: crimson" @endif>
                                                    <label class="form-check-label"
                                                           for="_{{$key + 1}}">{{$key + 1}}</label>
                                                </div>
                                            @endforeach
                                            <div class="d-flex justify-content-center">
                                                <div class="mt-1 me-3">{{$dish->rating}}/{{$dish->count}}</div>
                                                <button class="btn btn-primary btn-sm " type="submit">vote</button>

                                            </div>
                                        </form>
                                    </div>

                                    @endif
                                    <div class="card-footer">
                                        <small class="text-muted d-block">Last updated: </small>
                                        <small class="text-center">{{$dish->time}}</small>
                                    </div>
                                </div>

                            </div>
                        @empty
                            <h5 class="card-title">no dishes - no business</h5>
                    </div>
                    @endforelse


                </div>
            </div>
        </div>
    </div>

@endsection

