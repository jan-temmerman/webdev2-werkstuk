<?php

Route::name('pages.')->group(function () {
    Route::get('/', 'PageController@home')->name('home');
    Route::get('/projects', 'PageController@projects')->name('projects');
});

Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
