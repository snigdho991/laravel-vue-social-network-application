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

Route::get('/', [
  'uses' => 'Auth\LoginController@showLoginForm',
  'as'   => 'login'
]);


Auth::routes();

Route::get('/join', [
  'uses' => 'Auth\LoginController@showLoginForm',
  'as'   => 'join'
]);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::group(['middleware' => 'auth'], function(){

	Route::get('/timeline/{slug}', [
	  'uses' => 'ProfilesController@index',
	  'as'   => 'timeline'
	]);

	Route::get('/timeline/{slug}/basic', [
	  'uses' => 'ProfilesController@basic',
	  'as'   => 'timeline.basic'
	]);

	Route::get('/timeline/{slug}/background', [
	  'uses' => 'ProfilesController@background',
	  'as'   => 'timeline.background'
	]);

	Route::post('/timeline/basic/update', [
	  'uses' => 'ProfilesController@update',
	  'as'   => 'timeline.basic.update'
	]);

	Route::post('/timeline/background/update', [
	  'uses' => 'ProfilesController@background_update',
	  'as'   => 'timeline.background.update'
	]);

	Route::get('/newsfeed', function () {
	    return view('newsfeed');
	});

	Route::get('/check_status/{id}', [
		'uses' => 'FriendshipsController@check',
		'as'   => 'check'
	]);

	Route::get('/add_friend/{id}', [
		'uses' => 'FriendshipsController@add_friend',
		'as'   => 'add_friend'
	]);

	Route::get('/accept_friend/{id}', [
		'uses' => 'FriendshipsController@accept_friend',
		'as'   => 'accept_friend'
	]);

	Route::get('/decline_request/{id}', [
		'uses' => 'FriendshipsController@decline_request',
		'as'   => 'decline_request'
	]);

});
