<?php

Route::get('/login', ['as' => 'login', 'uses' => 'UsersController@index']);
Route::post('/login', ['as' => 'login', 'uses' => 'UsersController@login']);

Route::get('/logout', function () {
    \Auth::logout();
    return redirect('/');
});

Route::get('/notes', ['as' => 'notes', 'uses' => 'NotesController@index']);
Route::post('/notes', ['as' => 'notes.create', 'uses' => 'NotesController@store']);
Route::put('/notes/{note}', ['as' => 'notes.update', 'uses' => 'NotesController@update']);
Route::delete('/notes/{note}', ['as' => 'notes.delete', 'uses' => 'NotesController@destroy']);

Route::group(array('middleware' => 'auth'), function () {
    Route::get('/', ['as' => 'index', 'uses' => 'UsersController@repositories']);
    Route::get('/repositories/{owner}/{repository}/issues', ['as' => 'repository.issues', 'uses' => 'UsersController@issues']);
});