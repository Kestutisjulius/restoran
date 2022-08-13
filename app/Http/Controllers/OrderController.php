<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Dish;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request, int $uId){

        $dish = Dish::where('id', $request->dish_id)->first();

    $orderLine = collect(['dish' => $dish, 'orderCount' =>$request->count]);
        $order = new Order;
        $order->user_id = $uId;
        $order->order = json_encode($orderLine);
        $order->save();

        return redirect()->back();
    }
    public function index(){
        $orders = Order::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();



        return view('order.index', ['orders'=>$orders]);

    }
}
