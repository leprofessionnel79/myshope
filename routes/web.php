<?php

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

use App\City;
use App\Country;
use App\Image;
use App\Product;
use App\State;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\Route;


Route::get('users', function () {
    return User::paginate(15);
});

Route::get('cities', function () {
    return City::with(['country','state'])->paginate(4);
});

Route::get('products', function () {
    return Product::with(['images'])->paginate(200);
});

Route::get('images', function () {
    return Image::with(['product'])->paginate(200);
});

Route::get('test', function () {
    return 'hello';
})->middleware(['auth','Email_Verified']);


Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
