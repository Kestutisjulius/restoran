@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Your Orders List</div>
                    @foreach($orders as $order)
                        <div> {{$orders}}</div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
