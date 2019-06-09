<?php

Route::name('pages.')->group(function () {
    Route::get('/', 'PageController@home')->name('home');
    Route::get('/projects', 'PageController@projects')->name('projects');
    Route::get('/contact', 'PageController@contact')->name('contact');
    Route::get('/about', 'PageController@about')->name('about');
    Route::get('/policy', 'PageController@policy')->name('policy');
});

Route::name('user.')->group(function () {
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::get('stripe', 'PaymentController@getStripeForm')->name('payment');
    Route::post('stripe', 'PaymentController@postStripePayment')->name('post_payment');
});

Route::name('projects.')->group(function () {
    Route::get('/add_project', 'ProjectsController@addProject')->name('add_project');
    Route::post('/add_project', 'ProjectsController@postSave')->name('save');
    Route::get('/add_project/add_images', 'ProjectsController@addImage')->name('add_image');
    Route::post('/add_project/add_images', 'ProjectsController@postUpload')->name('upload');
    Route::post('/add_project/add_more_images', 'ProjectsController@postAnotherUpload')->name('another_upload');
    Route::delete('/profile/delete_project/{project}', 'ProjectsController@destroy')->name('destroy');
});

Route::post('api/convert', 'APIController@postConvert')->name('api.convert');

Auth::routes();
