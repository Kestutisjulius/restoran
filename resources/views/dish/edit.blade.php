@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">NEW delicious dish</div>
                    <form action="{{route('d_u', $dish)}}" method="post" class="p-3" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" aria-label="name" name="name" value="{{$dish->name}}">
                            <span class="input-group-text">& delicious price</span>
                            <input type="text" class="form-control" name="price" value="{{$dish->price}}">
                            <span class="input-group-text">€</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                        <div class="input-group mb-3">

                                <label class="input-group-text" for="inputGroupFile01">Upload photo</label>
                                <input type="file" class="form-control" id="inputGroupFile01" name="file">

                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">restaurant made it</label>
                            <select class="form-select" id="inputGroupSelect01" name="restaurant">

                                @foreach($restaurants as $restaurant)
                                    <option value="{{$restaurant->id}}" @if($dish->restoran_id == $restaurant->id) selected @endif>{{$restaurant->name}}</option>
                                @endforeach
                            </select>

                            <label class="input-group-text" for="inputGroupSelect02">Rating</label>
                            <select class="form-select" id="inputGroupSelect02" name="rating">

                                @foreach($ratings as $key => $rating)
                                <option @if($key +1  == $dish->rating) selected @endif value="{{$key +1}}" >{{$rating}}</option>
                                @endforeach
                            </select>
                        </div>
                                <button class="btn btn-primary" type="submit">save</button>
                    </form>

                            @if($dish->photo)
                                <form action="{{route('d_p', $dish)}}" method="post" class="d-flex justify-content-center mb-4">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-outline-danger me-3" type="submit">remove picture</button>
                                <img src="{{$dish->photo}}" alt="foto" class="e-img ms-3">
                                </form>
                            @endif





                </div>
            </div>
        </div>
    </div>
@endsection

