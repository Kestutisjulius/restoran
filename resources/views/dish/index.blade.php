@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dishes List</div>

                    <div class="card-header mb-3">
                        <h6 class="text-center">.......<strong>sorting</strong>.......</h6>
                        <div class="d-flex justify-content-between">
                            <a href="{{route('d_i', ['sort' => 'asc'])}}">name A to Z</a>
                            <a href="{{route('d_i', ['sort' => 'desc'])}}">name Z to A</a>
                            <a href="{{route('d_i', ['sort' => 'rating_asc'])}}">rating to low</a>
                            <a href="{{route('d_i', ['sort' => 'rating_desc'])}}">rating to high</a>
                            <a href="{{route('d_i')}}">Reset - from last</a>
                        </div>
                    </div>

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse($dishes as $dish)
                        <div class="col">
                            <div class="card h-100">

                                <img src="{{$dish->photo}}" class="card-img-top" alt="photo here">
                                <div class="card-body">
                                    <h5 class="card-title">"{{$dish->name}}"</h5>
                                    <h5>Price: {{$dish->price}} €</h5>
                                    <small>Restaurant: <strong>{{$dish->restaurant->name ?? 'still not Have restorante'}}</strong></small>
                                </div>
                                @if(Auth::user()->role >= 10)
                                <div class="btn-group" role="group">
                                    <a href="{{route('d_e', $dish->id)}}" type="button" class="btn btn-warning">Edit</a>
                                    <form class="btn btn-danger" action="{{route('d_d', $dish)}}" method="post">
                                        @csrf
                                        @method('delete')
                                    <button type="submit" class="bd">Delete</button>
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

