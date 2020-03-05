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

Auth::routes();
// Route::get('/', 'mainController@index')->name('main');



#CUSTOMERS
Route::get('/', 'Customers\dashboardController@publicCataloge')->name('customers.public'); 
Route::prefix('customer')->group(function(){
    Route::get('/', 'Customers\customersController@index')->name('customer.index');
    Route::post('/', 'Customers\customersController@login')->name('customer.login');
    Route::get('/create', 'Customers\customersController@create')->name('customer.create');
    Route::post('/register', 'Customers\customersController@register')->name('customer.register');
    Route::post('/logout', 'Customers\customersController@logout')->name('customer.logout');    
    Route::middleware('customer')->get('/dashboard', 'Customers\dashboardController@index')->name('customer.dashboard');
    Route::middleware('customer')->get('/basket', 'Customers\basketController@index')->name('customer.basket');
    Route::middleware('customer')->post('/basket/add', 'Customers\basketController@addToBasket')->name('customer.basket.add');
    Route::middleware('customer')->get('/basket/remove/{uuid}', 'Customers\basketController@remove')->name('customer.basket.remove');
    Route::middleware('customer')->get('/checkout/remove/{uuid}', 'Customers\checkoutController@index')->name('customer.checkout');
    Route::middleware('customer')->get('/checkout/success/{uuid}', 'Customers\checkoutController@successMsg')->name('customer.checkout.success');
    Route::middleware('customer')->get('/orders', 'Customers\orderController@index')->name('customer.order');
});

