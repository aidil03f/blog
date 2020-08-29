<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('home');
// });
Route::middleware('auth')->group(function(){

    Route::get('posts','PostController@index')->name('posts.index')->withoutMiddleware('auth');
    Route::get('posts/create','PostController@create')->name('posts.create');
    Route::post('posts/store','PostController@store');
    
    Route::get('posts/{post:slug}/edit','PostController@edit');
    Route::patch('posts/{post:slug}/edit','PostController@update');
    
    Route::delete('posts/{post:slug}/delete','PostController@destroy');
    Route::get('posts/{post:slug}','PostController@show')->withoutMiddleware('auth');
});


Route::get('categories/{category:slug}','CategoryController@show');
Route::get('tags/{tag:slug}','TagController@show');


Route::view('contact','contact');
Route::view('about','about');
Route::view('login','login');
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
