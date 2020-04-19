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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/app', function () {
    return view('app');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users', 'UsersController')->middleware(['auth']);

Route::resource('/books', 'BooksController');

Route::resource('/loaisachs', 'LoaisachsController');
Route::resource('/nhaxuatbans', 'NhaxuatbansController');
Route::resource('/tacgias', 'TacgiasController');

//Route::get('/favorites', 'FavoritesController')->middleware(['auth']);
Route::post('/checkout','CheckoutsController@index')->name('checkout.index')->middleware(['auth']);
Route::post('/checkout/store','CheckoutsController@store')->name('checkout.store')->middleware(['auth']);

Route::resource('/carts', 'CartsController')->middleware(['auth']);

Route::resource('/orders', 'OrdersController')->middleware(['auth']);

Route::resource('/reviews', 'ReviewsController');

Route::get('/about', function () {
    return view('about');
})->name('about');

