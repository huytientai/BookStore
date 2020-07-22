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

Route::get('neededImports', 'ImportsController@neededList')->name('imports.needed')->middleware('auth');

Route::resource('/imports', 'ImportsController')->middleware(['auth']);
Route::get('/imports/{id}/accept', 'ImportsController@accept')->name('imports.accept')->middleware('auth');
Route::get('/imports/{id}/denies', 'ImportsController@denies')->name('imports.denies')->middleware('auth');
Route::post('/imports/{id}/revert', 'ImportsController@revert')->name('imports.revert')->middleware('auth');

Route::post('/checkout', 'CheckoutsController@index')->name('checkout.index')->middleware(['auth']);
Route::post('/checkout/quick','CheckoutsController@quickCheckout')->name('checkout.quick')->middleware('auth');
Route::post('/checkout/store', 'CheckoutsController@store')->name('checkout.store')->middleware(['auth']);

Route::resource('/carts', 'CartsController')->middleware(['auth']);
Route::resource('/favorites', 'FavoritesController')->middleware(['auth']);

//---------------------------  Order ---------------------------------------------
Route::resource('/orders', 'OrdersController')->middleware('auth');     // manager cancel in destroy function
Route::delete('/orders/{id}/cancel', 'OrdersController@cancel')->name('orders.userCancel')->middleware('auth');    // user cancel
Route::get('/orders/{id}/modify', 'OrdersController@userEdit')->name('orders.userEdit')->middleware('auth');      // user edit order
Route::post('/orders/{id}/userUpdate', 'OrdersController@userUpdate')->name('orders.userUpdate')->middleware('auth');      // user edit order

Route::get('/orders/{id}/check', 'OrdersController@check')->name('orders.check')->middleware('auth');
Route::get('/orders/{id}/requestExport', 'OrdersController@requestExport')->name('orders.requestExport')->middleware('auth');
Route::get('/orders/{id}/confirmExport', 'OrdersController@confirmExport')->name('orders.confirmExport')->middleware('auth');
Route::get('/orders/{id}/shipping', 'OrdersController@shipping')->name('orders.shipping')->middleware('auth');
Route::get('/orders/{id}/shipped', 'OrdersController@shipped')->name('orders.shipped')->middleware('auth');
Route::get('/orders/{id}/done', 'OrdersController@done')->name('orders.done')->middleware('auth');
Route::get('/orders/{id}/confirmTakeBackBook', 'OrdersController@confirmTakeBackBooks')->name('orders.confirmTakeBackBook')->middleware('auth');
Route::get('/orders/{id}/revertToWaiting', 'OrdersController@revertToWaiting')->name('orders.revertToWaiting')->middleware('auth');
Route::get('/orders/{id}/revertToChecked', 'OrdersController@revertToChecked')->name('orders.revertToChecked')->middleware('auth');


Route::resource('/reviews', 'ReviewsController');

Route::get('/charts', 'ChartController@index')->name('charts.index')->middleware('auth');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Route::resource('/discount', 'DiscountController')->middleware('auth');

Route::get('/about', function () {
    return view('about');
})->name('about');


//checkout Gateway
                                // Checkout by momo
Route::post('/momo/checkout','CheckoutsController@momoRequest')->name('checkout.momo')->middleware('auth');
Route::get('/momo/success','CheckoutsController@getSuccessMomo')->name('momo.getSuccess')->middleware('auth');
Route::post('/momo/notify','CheckoutsController@momoNotify')->name('momo.notify');
//Route::get('')
Route::get('/momo/checkOrder/{id}','CheckoutsController@momoCheckOrder')->name('momo.checkOrder');

                                //checkout by vnpay



