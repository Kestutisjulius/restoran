@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Restaurants List</div>

                    <div class="card-header">
                        <h6 class="text-center">.......<strong>sorting</strong>.......</h6>
                        <div class="d-flex justify-content-between">
                            <a href="{{route('r_i', ['sort' => 'asc'])}}">name from A to Z</a>
                            <a href="{{route('r_i', ['sort' => 'desc'])}}">name from Z to A</a>
                            <a href="{{route('r_i')}}">Reset - from last</a>
                        </div>
                    </div>

        @foreach($restaurants as $restaurant)
                    <div class="card-body">
                    <div class="card-header d-flex justify-content-between r-txt"> {{$restaurant->name}}
                        <div class="btn-group" role="group" aria-label="Basic example">

        @if(Auth::user()->role >= 10)
                        <a href="{{route('r_e', $restaurant->id)}}" type="button" class="btn btn-secondary">edit</a>

                            <form type="button" class="btn btn-danger" action="{{route('r_d', $restaurant)}}" method="post">
                                @csrf
                                @method('delete')
                        <button type="submit" class="bd">Del</button>
                            </form>
                            @endif
                        </div>
                    </div>
                        <div class="card-title ms-3"><strong>Adresas:</strong> {{$restaurant->city}}, {{$restaurant->address}}</div>
                    <div class="card-subtitle ms-3 text-muted">Restourant work time: <strong>{{$restaurant->work_time}}</strong>  </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
