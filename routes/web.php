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
use App\Tag;
use App\Unit;
use App\User;
use Illuminate\Support\Facades\Route;


Route::get('tag_test', function () {
    $tag=Tag::find(2);
    return $tag->products;
});

Route::get('product_test', function () {

    $product=Product::find(1);
    return $product->tags;
});

// Route::get('cities', function () {
//     return City::with(['country','state'])->paginate(4);
// });

// Route::get('products', function () {
//     return Product::with(['images'])->paginate(200);
// });

// Route::get('images', function () {
//     return Image::with(['product'])->paginate(200);
// });

Route::get('test', function () {
    return 'hello';
})->middleware(['auth','User_Is_Admin']);

Route::middleware(['auth', 'User_Is_Admin'])->group(function () {

    Route::get('add_unit','UnitController@showAdd')->name('new-unit');
    Route::get('units','UnitController@index')->name('units');
    //categories

    Route::get('categories','CategoryController@index')->name('categories');

    //products

    Route::get('products','ProductController@index')->name('products');
});


Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
