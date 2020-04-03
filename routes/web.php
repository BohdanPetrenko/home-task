<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@welcome');

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/payment-card', 'PaymentCardController')
        ->only('index', 'create', 'store')
        ->names('payment.card');

    Route::group([
        'prefix' => '/profile'
    ], function(){
        Route::get('/','UserProfileController@index')->name('profile.index');
        Route::get('/edit','UserProfileController@edit')->name('profile.edit');
        Route::put('/','UserProfileController@update')->name('profile.update');
    });
});

Route::group([
    'prefix' => '/transaction'
], function () {
    Route::get('/', 'TransactionController@index')->name('transaction.index');
    Route::patch('/', 'TransactionController@transaction')->name('transaction.make');
    Route::get('/{cardNumber}', 'TransactionController@log')
        ->name('transaction.show')
        ->middleware('auth');
});