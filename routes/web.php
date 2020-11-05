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

Route::get('/','InquiryController@index');

Route::get('bootstrap',function() {
    return view('template');
});

Route::post('inquiry','InquiryController@postInquiry')->name('inquiry');

Route::get('confirm','InquiryController@showConfirm')->name('confirm');