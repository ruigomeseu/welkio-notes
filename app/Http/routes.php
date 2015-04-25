<?php

Route::get('/login', ['as' => 'login', 'uses' => 'UsersController@index']);
Route::post('/login', ['as' => 'login', 'uses' => 'UsersController@login']);

Route::get('/logout', function()
{
   \Auth::logout();
});

Route::get('/notes', ['as' => 'notes', 'uses' => 'NotesController@index']);

Route::group(array('middleware' => 'auth'), function () {
    Route::get('/', ['as' => 'index', 'uses' => 'UsersController@repositories']);
    Route::get('/repositories/{owner}/{repository}/issues', ['as' => 'repository.issues', 'uses' => 'UsersController@issues']);
});