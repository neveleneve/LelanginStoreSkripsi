<?php

use Illuminate\Support\Facades\Route;

// all user can access
Route::get('/', 'HomeController@landing')->name('landing');
Route::get('started-soon', 'HomeController@startsoon')->name('startsoon');
Route::get('ended-soon', 'HomeController@endsoon')->name('endsoon');
Route::get('ended', 'HomeController@ended')->name('ended');
Route::get('profile/{id}', 'HomeController@viewprofile')->name('viewprofile');
Route::get('item/{id}', 'HomeController@viewitem')->name('viewitem');

// guest only
Route::group(['middleware' => 'guest'], function () {
    Route::get('register', 'RegisterController@index')->name('register'); //done
    Route::post('register', 'RegisterController@store')->name('register'); //done
    Route::get('login', 'LoginController@index')->name('login'); //done
    Route::post('login', 'LoginController@authenticate')->name('login'); //done
});

// all authenticated user
Route::group(['middleware' => 'auth'], function () {
    Route::get('setting', 'HomeController@setting')->name('setting');
    Route::get('profile', 'HomeController@index')->name('profile');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // payments
    Route::get('payment/finish', 'PaymentsController@finish')->name('finishpayment');
    Route::get('payment/unfinish', 'PaymentsController@unfinish')->name('unfinishpayment');
    Route::get('payment/error', 'PaymentsController@error')->name('errorpayment');

    Route::get('payment/check', 'PaymentsController@check')->name('checkpayment');

    Route::post('payment/cancel', 'PaymentsController@cancel')->name('cancelpayment');
    Route::post('join-bid', 'PaymentsController@joinbid')->name('joinbid');
});

Route::group(['middleware' => 'peserta'], function () {
    Route::get('penawaran', 'PesertaController@penawaran')->name('pesertapenawaran');
    Route::post('ikut-lelang', 'PesertaController@ikutlelang')->name('pesertaikutlelang');
});

Route::group(['middleware' => 'pelelang'], function () {
    Route::get('items', 'PelelangController@item')->name('pelelangitem');
    Route::get('items/add', 'PelelangController@itemadd')->name('pelelangitemadd');
    // 
});

// auth admin with prefix /admin
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('dashboard', 'AdminController@dashboard')->name('admindashboard');
    Route::get('users', 'AdminController@users')->name('adminusers');
    Route::get('payments', 'AdminController@payments')->name('adminpayments');
    Route::get('web-setting', 'AdminController@websetting')->name('adminwebsetting');
    // if (Auth::user()->role == 0) {
    Route::get('administrators', 'AdminController@usersadmin')->name('adminusersadmin');
    // }

    Route::get('items', 'AdminController@items')->name('adminitems');
});
