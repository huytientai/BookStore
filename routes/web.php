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

// for server
Route::get('/linkstorage', function () {
    if(!is_dir('/home/u441737116/public_html/storage')){
        symlink('/home/u441737116/domains/bookstore-00.hostingerapp.com/storage/app/public','/home/u441737116/public_html/storage');
        return 'storage link done';
    }
    return 'It is already link';;
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
Route::post('/checkout/quick', 'CheckoutsController@quickCheckout')->name('checkout.quick')->middleware('auth');
Route::post('/checkout/store', 'CheckoutsController@store')->name('checkout.store')->middleware(['auth']);

Route::resource('/carts', 'CartsController')->middleware(['auth']);
Route::resource('/favorites', 'FavoritesController')->middleware(['auth']);

//---------------------------  Order  ---------------------------------------------
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

// returns request
Route::get('/orders/{id}/createReturnsRequest', 'OrdersController@createReturnsRequest')->name('orders.createReturnsRequest')->middleware('auth');
Route::get('/returnsRequestsList', 'OrdersController@returnsRequestsList')->name('orders.returnsRequestsList')->middleware('auth');
Route::post('/orders/{id}/acceptReturnsRequest', 'OrdersController@acceptReturnsRequest')->name('orders.acceptReturnsRequest')->middleware('auth');
Route::post('/orders/{id}/deniesReturnsRequest', 'OrdersController@deniesReturnsRequest')->name('orders.deniesReturnsRequest')->middleware('auth');
Route::delete('/orders/{id}/cancelReturnsRequest','OrdersController@cancelReturnsRequest')->name('orders.cancelReturnsRequest')->middleware('auth');

// returns info
Route::resource('/returns','ReturnsController')->middleware('auth');
Route::get('/returns/list/xxx', 'ReturnsController@list')->name('returns.user_list')->middleware('auth');


Route::resource('/reviews', 'ReviewsController');

Route::get('/charts', 'ChartController@index')->name('charts.index')->middleware('auth');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');

Route::resource('/discount', 'DiscountController')->middleware('auth');

Route::get('/about', function () {
    return view('about');
})->name('about');

//                                       Checkout with point
Route::post('/checkout/point', 'CheckoutsController@checkoutByPoint')->name('checkout.point')->middleware('auth');

//-------------------------------------  checkout Gateway  -----------------------------------------------

//                                       Checkout by MoMo
Route::post('/momo/checkout', 'CheckoutsController@momoRequest')->name('checkout.momo')->middleware('auth');
Route::get('/momo/success', 'CheckoutsController@getSuccessMomo')->name('momo.getSuccess')->middleware('auth');
Route::post('/momo/notify', 'CheckoutsController@momoNotify')->name('momo.notify');
Route::get('/momo/checkOrder/{id}', 'CheckoutsController@momoCheckOrder')->name('momo.checkOrder');

//                                      Checkout by VNPay
Route::post('/vnpay/checkout', 'CheckoutsController@vnpayRequest')->name('checkout.vnpay')->middleware('auth');
Route::get('/vnpay/success', 'CheckoutsController@getSuccessVnpay')->name('vnpay.getSuccess')->middleware('auth');
//Route::post('/vnpay/notify', 'CheckoutsController@vnpayNotify')->name('vnpay.notify');
//Route::get('/vnpay/checkOrder/{id}','CheckoutsController@vnnpayCheckOrder')->name('vnpay.checkOrder');

//                                       Checkout by ONEPay
Route::post('/onepay/checkout', 'CheckoutsController@onepayRequest')->name('checkout.onepay')->middleware('auth');
Route::get('/onepay/success', 'CheckoutsController@getSuccessOnepay')->name('onepay.getSuccess')->middleware('auth');
Route::post('/onepay/notify', 'CheckoutsController@onepayNotify')->name('onepay.notify');
//Route::get('/onepay/checkOrder/{id}', 'CheckoutsController@onepayCheckOrder')->name('onepay.checkOrder');

//                                       Checkout by VTCPay
Route::post('/vtcpay/checkout', 'CheckoutsController@vtcpayRequest')->name('checkout.vtcpay')->middleware('auth');
Route::get('/vtcpay/success', 'CheckoutsController@getSuccessVtcpay')->name('vtcpay.getSuccess')->middleware('auth');
Route::post('/vtcpay/notify', 'CheckoutsController@vtcpayNotify')->name('vtcpay.notify');
//Route::get('/vtcpay/checkOrder/{id}', 'CheckoutsController@vtcpayCheckOrder')->name('vtcpay.checkOrder');


//--------------------------------------  Returns  --------------------------------------------
Route::resource('/returns','ReturnsController');
