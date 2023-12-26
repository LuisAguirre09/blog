<?php

// Rutas invitados
Route::get('/', 'WelcomeController@welcome')->name('welcome'); // index
Route::get('/tema/{tema}', 'ThemeController@show')->name('tema.show'); // Articulos de cada tema
Route::get('/buscador', 'SearchController@index');