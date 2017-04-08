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


Route::get('/', function () {
    return view('login');
});

Route::get('about', 'PhotoController@loginUser');

Route::get('auth','PhotoController@token');

Route::get('return','PhotoController@returnData');

Route::post('currentlocation','PhotoController@location');

Route::get('photos', function (){
	return view('photos');
});

Route::get('photosload', 'PhotoController@recentPhotos');


Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('location', function (){
	return view('location');
});


Route::get('followsyou', function (){
	return view('followsyou');
});


Route::get('getFollowers', 'PhotoController@followers');


Route::post('getMore','PhotoController@extraData');


Route::get('landing', function (){
	return view('landing');
});


Route::get('basicinfo','PhotoController@returnData');

Route::get('logout','PhotoController@logOut');


Route::get('followsme', function (){
	return view('followsme');
});



Route::get('followme','PhotoController@followsme');