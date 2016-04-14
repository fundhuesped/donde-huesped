<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'MainRouteController@home');
Route::get('/form', 'MainRouteController@form');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');


///////////////////////////////////////////////
/////////// Backoffice CMS
///////////////////////////////////////////////

Route::group(['middleware' => 'auth'], function () {
	// Registration routes...
	Route::get('panel/auth/register', 'Auth\AuthController@getRegister');
	Route::post('panel/auth/register', 'Auth\AuthController@postRegister');

    Route::get('panel', 'MainRouteController@panel');
    Route::get('panel/places/confirmation', 'MainRouteController@formEditConfirmation');
   	



    Route::get('panel/places/{id}', 'MainRouteController@places');
    Route::get('panel/places/pre/{id}', 'MainRouteController@placesPre');


	Route::get('panel/admin-list', 'MainRouteController@adminList');
	Route::get('panel/city-list', 'MainRouteController@cityList');
	Route::get('panel/logged', 'AdminRESTController@logged');


    Route::get('api/v1/panel/places/approved/{pid}/{cid}/{bid}', 'PlacesRESTController@showApproved');
	Route::get('api/v1/panel/places/blocked', 'PlacesRESTController@showDreprecated');
	Route::get('api/v1/panel/places/pending', 'PlacesRESTController@showPending');
	

	
	Route::get('api/v1/panel/places/{id}', 'PlacesRESTController@showPanel');
	

	
	Route::post('api/v1/panel/places/{id}/update', 'PlacesRESTController@update');
	Route::post('api/v1/panel/places/{id}/approve', 'PlacesRESTController@approve');
	Route::post('api/v1/panel/places/{id}/block',  'PlacesRESTController@block');

});

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');




Route::get('api/v1/places/all', 'PlacesRESTController@getAll');
Route::get('api/v1/places/{pid}/{cid}/{bid}', 'PlacesRESTController@getScalar');
Route::get('api/v1/countries/all', 'PaisRESTController@getAll');
Route::get('api/v1/countries/{id}/provinces', 'PaisRESTController@getProvinces');
Route::get('api/v1/provinces/{id}/cities', 'PaisRESTController@getCities');




