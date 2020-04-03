<?php

Route::get('/', 'AdminController@index')->name('index');
Route::get('/users', 'AdminController@users')->name('users');
Route::get('/transactions', 'AdminController@transactions')->name('transactions');