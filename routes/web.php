<?php

Route::get('/', 'PageController@home');
Route::get('/profile/{uid}', 'PageController@profile');
Route::get('/reset-password/{hash}', 'PageController@resetPassword');
