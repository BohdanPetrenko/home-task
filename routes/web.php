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
        'as' => 'profile.',
        'prefix' => '/profile'
    ], function(){
        Route::get('/','UserProfileController@index')->name('index');
        Route::get('/edit','UserProfileController@edit')->name('edit');
        Route::put('/','UserProfileController@update')->name('update');
    });
});

Route::group([
    'as' => 'transaction.',
    'prefix' => '/transaction'
], function () {
    Route::get('/', 'TransactionController@index')->name('index');
    Route::patch('/', 'TransactionController@transaction')->name('make');
    Route::get('/{cardNumber}', 'TransactionController@log')
        ->name('show')
        ->middleware('auth');
});