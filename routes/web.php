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
Route::post('/books/{id}/importRequest', 'BooksController@storeImportRequest')->name('books.importRequest');

Route::resource('/loaisachs', 'LoaisachsController');
Route::resource('/nhaxuatbans', 'NhaxuatbansController');
Route::resource('/tacgias', 'TacgiasController');

Route::resource('/imports', 'ImportsController')->middleware(['auth']);
Route::get('/imports/{id}/accept','ImportsController@accept')->name('imports.accept')->middleware('auth');
Route::get('/imports/{id}/denies', 'ImportsController@denies')->name('imports.denies')->middleware('auth');
Route::post('/imports/{id}/revert','ImportsController@revert')->name('imports.revert')->middleware('auth');

//Route::get('/favorites', 'FavoritesController')->middleware(['auth']);
Route::post('/checkout', 'CheckoutsController@index')->name('checkout.index')->middleware(['auth']);
Route::post('/checkout/store', 'CheckoutsController@store')->name('checkout.store')->middleware(['auth']);

Route::resource('/carts', 'CartsController')->middleware(['auth']);

Route::resource('/orders', 'OrdersController')->middleware(['auth']);
Route::get('/orders/{id}/finish', 'OrdersController@finish')->middleware('auth')->name('orders.finish');

Route::resource('/reviews', 'ReviewsController');

Route::get('/charts', 'ChartController@index')->name('charts.index')->middleware('auth');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Route::get('/about', function () {
    return view('about');
})->name('about');

