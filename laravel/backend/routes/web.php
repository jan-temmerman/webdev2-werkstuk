<?php

Route::name('pages.')->group(function () {
    Route::get('/', 'PageController@home')->name('home');
    Route::get('/projects', 'PageController@projects')->name('projects');
    Route::get('/policy', 'PageController@policy')->name('policy');
});

Route::name('projects.')->group(function () {
    Route::get('/add_project', 'ProjectsController@addProject')->name('add a project');
    Route::post('/', 'ProjectsController@postSave')->name('save');
});

Route::name('user.')->group(function () {
});

Auth::routes();

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
