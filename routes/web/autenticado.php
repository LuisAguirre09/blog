<?php


// Rutas de usuarios autenticados
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::put('/usuario-actualizar', 'UserController@update');