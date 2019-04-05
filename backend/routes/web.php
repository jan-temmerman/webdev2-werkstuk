<?php

Route::name('pages.')->group(function () {
    Route::get('/', 'AddController@sendAdd')->name('home');
});

Auth::routes();
