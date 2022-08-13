<?php

namespace App\Http\Controllers;

use App\Models\Restaurant as R;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{

    public function index(Request $request){
        $restaurants = match ($request->sort){
            'asc' => R::orderBy('name', 'asc')->get(),
            'desc' => R::orderBy('name', 'desc')->get(),
            default => R::orderBy('id', 'desc')->get()
        };
        return view('restoran.index', ['restaurants' => $restaurants]);
    }
    public function edit(int $restaurantId){
        $restaurant = R::where('id', $restaurantId)->first();
        return view('restoran.edit', ['restaurant'=>$restaurant]);
    }
    public function update(Request $request, R $restaurant){
        $restaurant->name = $request->name;
        $restaurant->city = $request->city;
        $restaurant->address = $request->address;
        $restaurant->work_time = $request->work_time;
        $restaurant->save();

        return redirect()->route('r_i');
    }
    public function create(){
        return view('restoran.create');
    }
    public function store(Request $request){
        $restaurant = new R;
        $restaurant->name = $request->name;
        $restaurant->city = $request->city;
        $restaurant->address = $request->address;
        $restaurant->work_time = $request->work_time;
        $restaurant->save();

        return redirect()->route('r_i');
    }
    public function destroy(R $restaurant){
        $restaurant->delete();
        return redirect()->route('r_i');
    }
}
