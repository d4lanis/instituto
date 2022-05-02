<?php

use App\Models\Role;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>true]);

Route::middleware(['auth'])->group(function () {

	Route::get('/home', 'HomeController@index')->name('home');	
	//Route::resource('profile','ProfileController');
});	

