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

Route::get('/','InquiryController@index')->name('index');

Route::get('bootstrap',function() {
    return view('template');
});

Route::post('inquiry','InquiryController@postInquiry')->name('inquiry');

Route::get('confirm','InquiryController@showConfirm')->name('confirm');

Route::post('confirm','InquiryController@postConfirm')->name('confirm');

Route::get('sent','InquiryController@showSentMessage')->name('sent');