@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">NEW delicious dish</div>
                    <form action="{{route('d_s')}}" method="post" class="p-3" enctype="multipart/form-data">
                        @csrf
                        @method('post')
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="name of dishes" aria-label="name" name="name">
                            <span class="input-group-text">& delicious price</span>
                            <input type="text" class="form-control" name="price">
                            <span class="input-group-text">€</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">Upload photo</label>
                            <input type="file" class="form-control" id="inputGroupFile01" name="file">
                        </div>
                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">restourant mede it</label>
                            <select class="form-select" id="inputGroupSelect01" name="restaurant">
                                <option selected>Choose...</option>
                                @foreach($restaurants as $restaurant)
                                <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                                @endforeach
                            </select>

                                <label class="input-group-text" for="inputGroupSelect02">Rating</label>
                                <select class="form-select" id="inputGroupSelect02" name="rating">
                                    <option selected>Choose...</option>
                                    <option value="1">Bad</option>
                                    <option value="2">Not bad</option>
                                    <option value="3">litle Delicious</option>
                                    <option value="4">Delicious</option>
                                    <option value="5">Divine</option>
                                </select>
                        </div>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button class="btn btn-primary" type="submit">save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

