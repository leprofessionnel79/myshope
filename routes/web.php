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

use App\Image;
use App\Product;
use App\User;
use Illuminate\Support\Facades\Route;


Route::get('users', function () {
    return User::paginate(15);
});

Route::get('products', function () {
    return Product::paginate(200);
});

Route::get('images', function () {
    return Image::paginate(200);
});




Route::get('/', function () {
    return view('welcome');
});
