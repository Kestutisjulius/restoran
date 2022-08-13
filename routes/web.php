<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController as R;
use App\Http\Controllers\DishController as D;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [F::class, 'index'])->name('f_i');


Route::get('/restaurants', [R::class, 'index'])->name('r_i')->middleware('role:user');
Route::get('/restaurants/edit/{restaurantId}', [R::class, 'edit'])->name('r_e')->middleware('role:admin');
Route::put('/restaurants/update/{restaurant}', [R::class, 'update'])->name('r_u')->middleware('role:admin');
Route::get('/restaurants/create', [R::class, 'create'])->name('r_c')->middleware('role:admin');
Route::post('/restaurants/store', [R::class, 'store'])->name('r_s')->middleware('role:admin');
Route::delete('/restaurants/delete/{restaurant}', [R::class, 'destroy'])->name('r_d')->middleware('role:admin');

Route::get('/dishes', [D::class, 'index'])->name('d_i')->middleware('role:user');
Route::get('/dishes/edit/{dishId}', [D::class, 'edit'])->name('d_e')->middleware('role:admin');
Route::put('/dishes/update/{dish}', [D::class, 'update'])->name('d_u')->middleware('role:admin');
Route::get('/dishes/create', [D::class, 'create'])->name('d_c')->middleware('role:admin');
Route::post('/dishes/store', [D::class, 'store'])->name('d_s')->middleware('role:admin');
Route::delete('/dishes/delete/{dish}', [D::class, 'destroy'])->name('d_d')->middleware('role:admin');
Route::put('/dishes/photo/delete/{dish}', [D::class, 'del'])->name('d_p')->middleware('role:admin');
Route::put('/dishes/vote/{dishId}', [D::class, 'vote'])->name('vote')->middleware('role:user');

Route::post('/order/{uId}', [O::class, 'store'])->name('order')->middleware('role:user');
Route::get('/my/orders', [O::class, 'index'])->name('orders')->middleware('role:user');

