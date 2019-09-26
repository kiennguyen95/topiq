<?php

Route::get('/', 'PageController@home')->name('home');
Route::get('/profile/{uid}', 'PageController@profile')->name('profile');
Route::get('/reset-password/{token}', 'PageController@resetPassword')->name('reset_password');
Route::post('/change-password/{token}', 'PageController@changePassword')->name('change_password');
Route::get('/verify-email/{id}/{token}', 'PageController@verifyEmail')->name('verify_email');
Route::get('/top-up', 'PageController@topUp');
Route::get('/payment-history', 'PageController@paymentHistory');
