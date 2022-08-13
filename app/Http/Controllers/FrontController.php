<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Restaurant as R;

class FrontController extends Controller
{
    public function index(Request $request)
    {

        if ($request->s) {

            list($w1, $w2) = explode(' ', $request->s.' ');
                $rId = R::select('id')->where('name', 'like', '%'.$w1.'%')->where('name', 'like', '%'.$w2.'%')->first();
            if ($rId == null){
                $dishes = [Dish::orderBy('name', 'desc')->get()->map(function ($dish) {
                        $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                        $dish->time = $time->format('Y-M-d (H:i:s)');
                        return $dish;
                    })->shuffle(), 'default'];
                $filter = 0;
            } else{

            $dishes = [Dish::where('restaurant_id', $rId->id)
                ->orderBy('name', 'desc')->get()->map(function ($dish) {
                $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                $dish->time = $time->format('Y-M-d (H:i:s)');
                return $dish;
            })->shuffle(), 'default'];
            $filter = 0;
            }
        } else {
            if (!$request->restaurant_id) {
                $dishes = match ($request->sort){
                    'price-asc' => [Dish::orderBy('price', 'asc')->get()->map(function ($dish) {
                        $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                        $dish->time = $time->format('Y-M-d (H:i:s)');
                        return $dish;
                    }), 'price-asc'],
                    'price-desc' => [Dish::orderBy('price', 'desc')->get()->map(function ($dish) {
                        $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                        $dish->time = $time->format('Y-M-d (H:i:s)');
                        return $dish;
                    }), 'price-desc'],
                    default => [Dish::orderBy('id', 'desc')->get()->map(function ($dish) {
                        $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                        $dish->time = $time->format('Y-M-d (H:i:s)');
                        return $dish;
                    }), 'default']
                };
                $filter = 0;


            } else {
                $dishes = match ($request->sort){
                    'price-asc' => [Dish::where('restaurant_id', $request->restaurant_id)->orderBy('price', 'asc')->get()->map(function ($dish) {
                        $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                        $dish->time = $time->format('Y-M-d (H:i:s)');
                        return $dish;
                    }), 'price-asc'],
                    'price-desc' => [Dish::where('restaurant_id', $request->restaurant_id)->orderBy('price', 'desc')->get()->map(function ($dish) {
                        $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                        $dish->time = $time->format('Y-M-d (H:i:s)');
                        return $dish;
                    }), 'price-desc'],
                    default => [Dish::where('restaurant_id', $request->restaurant_id)->orderBy('id', 'desc')->get()->map(function ($dish) {
                        $time = Carbon::create($dish->updated_at)->timezone('Europe/Vilnius');
                        $dish->time = $time->format('Y-M-d (H:i:s)');
                        return $dish;
                    }), 'default']
                };
                $filter = (int)$request->restaurant_id;
            }
        }
        $ratings = Dish::ratings;
        return view('front.index', [
            'dishes' => $dishes[0],
            'sort' => $dishes[1],
            'filter'=>$filter,
            'restaurants'=>R::all(),
            's'=> $request->s ?? '',
            'ratings' => $ratings
        ]);

    }

}
