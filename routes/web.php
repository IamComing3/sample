<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('help', 'StaticPagesController@home')->name('help');
Route::get('about', 'StaticPagesController@home')->name('about');

Route::get('signup','UserController@create')->name('signup');
Route::get('signup/confirm/{token}', 'UserController@confirmEmail')->name('confirm_email');

Route::get('login', 'SessionController@create')->name('login');
Route::post('login', 'SessionController@store')->name('login');
Route::delete('logout', 'SessionController@destroy')->name('logout');

Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('users', 'UserController');

Route::resource('statuses', 'StatusesController',['only' => ['store', 'destroy']]);

Route::get('users/{user}/followings', 'UserController@followings')->name('users.followings');
Route::get('users/{user}/followers', 'UserController@followers')->name('users.followers');

Route::post('users/followers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');
