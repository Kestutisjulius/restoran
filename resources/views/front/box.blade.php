<div class="row justify-content-center mb-0">
    <div class="col-lg-11">
        <div class="card-header">sort, filter & search box</div>
        <div class="card-body">
            <form class="form-control " action="{{route('f_i')}}" method="get">
                <div class="flex-lg-row">
                    <!-- -->
                    <label for="f" class="ms-4 col-form-label-sm">what sort?</label>
                    <select class="form-select-sm" name="sort" id="f">
                        <option value="default" @if($sort == 'default') selected @endif>Default Sort</option>
                        <option value="price-asc" @if($sort == 'price-asc') selected @endif> Price A-Z</option>
                        <option value="price-desc" @if($sort == 'price-desc') selected @endif> Price Z-A</option>

                    </select>
                    <!-- -->
                    <label for="restaurant_id" class="ms-4 col-form-label-sm">what restaurant ?</label>
                    <select class="form-select-sm " name="restaurant_id" id="restaurant_id">
                        <option value="0" @if($filter == 0) selected @endif>no filter</option>
                        @foreach($restaurants as $restaurant)
                            <option value="{{$restaurant->id}}" @if($filter == $restaurant->id) selected @endif>{{$restaurant->name}}</option>
                        @endforeach
                    </select>
                    <!-- -->
                    <button type="submit" class="btn btn-sm btn-outline-secondary m-2 ">sort</button>
                    <a class="btn btn-sm btn-outline-success " href="{{route('f_i')}}">Clear!</a>
                </div>
            </form>
            <form class="form-control mb-3 mt-1" action="{{route('f_i')}}" method="get">
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Restaurant search</span>
                                <input class="form-control " type="text" name="s" value="{{$s}}"/>
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Search!</button>
                            </div>
            </form>
        </div>

    </div>
</div>





