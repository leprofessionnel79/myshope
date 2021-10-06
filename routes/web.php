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

    // units

    Route::get('add_unit','UnitController@showAdd')->name('new-unit');

    Route::get('units','UnitController@index')->name('units');
    Route::post('units','UnitController@store');
    Route::delete('units','UnitController@delete');
    Route::put('units','UnitController@update');
    Route::get('units-search','UnitController@search')->name('units-search');
    //categories

    Route::get('categories','CategoryController@index')->name('categories');

    //products

    Route::get('products','ProductController@index')->name('products');

    Route::get('new-product','ProductController@newProduct')->name('new-product');
    Route::get('update-product/{id}','ProductController@newProduct')->name('update-product');

    Route::put('new-product','ProductController@update')->name('update-product');
    Route::post('new-product','ProductController@store');


    Route::delete('products','ProductController@delete');








    //reviews
    Route::get('reviews','ReviewController@index')->name('reviews');
    //tickets
    Route::get('tickets','TicketController@index')->name('tickets');
    //tags

    Route::get('tags','TagController@index')->name('tags');
    Route::post('tags','TagController@store')->name('tags');
    Route::get('tags-search','TagController@search')->name('tags-search');
    Route::delete('tags','TagController@delete');
    Route::put('tags','TagController@update');
    //orders
    //payments
    //shipments

    //countries
    Route::get('countries','CountryController@index')->name('countries');
    //cities
    Route::get('cities','CityController@index')->name('cities');

    //states
    Route::get('states','StateController@index')->name('states');
    //role
    Route::get('roles','RoleController@index')->name('roles');

});


Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
