<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Models\Restaurant as R;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DishController extends Controller
{
    public function index(Request $request){
        $dishes = match ($request->sort){
            'asc' => Dish::orderBy('name', 'asc')->get(),
            'desc' => Dish::orderBy('name', 'desc')->get(),
            'rating_asc' => Dish::orderBy('rating', 'asc')->get(),
            'rating_desc' => Dish::orderBy('rating', 'desc')->get(),
            default => Dish::orderBy('id', 'desc')->get()
        };
        $dishes = $dishes->map(function($dish){
            $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
            $dish->time = $time->format('Y-M-d (H:i:s)');
            return $dish;
        });
        return view('dish.index', ['dishes'=> $dishes]);
    }
    public function create(){
        return view('dish.create', ['restaurants'=>R::all()]);
    }
    public function store(Request $request){
        $dish = new Dish;

        if ($request->file('file')){
            $photo = $request->file('file');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);
            $file = $name.'-'.time().'.'.$ext;
        }
        $photo->move(public_path().'/images', $file);
        $dish->photo = asset('/images'.'/'.$file);
        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->rating = $request->rating;
        $dish->restaurant_id = $request->restaurant;
        $dish->save();

        return redirect()->route('d_i');
    }
    public function edit(int $dishId){
        $dish = Dish::where('id', $dishId)->first();
        $restaurants = R::all();
        $ratings = Dish::ratings;
        return view('dish.edit',['dish'=>$dish, 'restaurants'=>$restaurants, 'ratings'=>$ratings]);
    }

    public function update(Request $request, Dish $dish){
        if ($request->file('file')){
            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $extension = pathinfo($dish->photo, PATHINFO_EXTENSION);
            $file = asset('/images'.'/'.$name.'.'.$extension);

            if (file_exists($file))
            {
                unlink($file);
            }
            $photo = $request->file('file');
            $ext = $photo->getClientOriginalExtension();
            $name = pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME);

            $file = $name.'-'.time().'.'.$ext;
        $photo->move(public_path().'/images', $file);
        $dish->photo = asset('/images'.'/'.$file);
        }

        $dish->name = $request->name;
        $dish->price = $request->price;
        $dish->rating = $request->rating;
        $dish->restaurant_id = $request->restaurant;
        $dish->save();

        return redirect()->route('d_i');
    }
    public function destroy(Dish $dish){
        if ($dish->photo){
            $name = pathinfo($dish->photo, PATHINFO_FILENAME);
            $extension = pathinfo($dish->photo, PATHINFO_EXTENSION);
            $file = public_path().'/images'.'/'.$name.'.'.$extension;
            if (file_exists($file)) {
                unlink($file);
            }
        }
        $dish->delete();
        return redirect()->route('dish_index');
    }
    public function del(Dish $dish){
        $name = pathinfo($dish->photo, PATHINFO_FILENAME);
        $extension = pathinfo($dish->photo, PATHINFO_EXTENSION);
        $file = public_path().'/images'.'/'.$name.'.'.$extension;
        if (file_exists($file)){
            unlink($file);
        }
        $dish->photo = null;
        $dish->save();

        return redirect()->back();
    }
    public function vote(Request $request, int $dishId){

        $dish = Dish::where('id', $dishId)->first();
        $dish->count ++;
        $dish->rating += $request->vote;
        $dish->save();
        return redirect()->back();
//        dump($dish->name);
    }
}
