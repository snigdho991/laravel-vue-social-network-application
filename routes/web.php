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

	Route::get('/collectfeed', [
	  'uses' => 'FeedsController@feed',
	  'as'   => 'newsfeed'
	]);

	Route::get('/newsfeed', function(){
		return view('newsfeed');
	});

	Route::get('/notifications', [
		'uses' => 'ProfilesController@notifications',
		'as'   => 'notifications'
	]);

	Route::get('/requests', [
		'uses' => 'FriendshipsController@pending_friend_requests',
		'as'   => 'pending_friend_requests'
	]);

	/*Route::get('/limit_notifications', [
		'uses' => 'ProfilesController@limit_notifications',
		'as'   => 'limit_notifications'
	]);*/

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

	Route::get('/get_unread_notification', [
		'uses' => 'FriendshipsController@unread_notification',
		'as'   => 'unread_notification'
	]);

	Route::get('/mark_notification_as_read', [
		'uses' => 'FriendshipsController@mark_notification_as_read',
		'as'   => 'mark_notification_as_read'
	]);

	Route::get('/mark_request_as_read', [
		'uses' => 'FriendshipsController@mark_request_as_read',
		'as'   => 'mark_request_as_read'
	]);

	Route::post('/create/post/new', [
		'uses' => 'PostsController@store',
		'as'   => 'post.store'
	]);

	Route::post('/post/image/save', [
		'uses' => 'PostsController@save_image',
		'as'   => 'post.save.image'
	]);

});
