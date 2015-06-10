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

Route::post('login','PublicController@authenticate');
Route::get('login','PublicController@login');
Route::get('logout','PublicController@logout');

/**
 * Our private pages...
 */
Route::group(['middleware' => 'auth'], function()
{
	Route::get('/',function()
	{
		return redirect('start');
	});
	Route::get('start','PrivateController@start');
	Route::get('schools/list/{schools}', 
		['as' => 'schoollist', 'uses' => 'SchoolsController@getList']);

	//Resources:
	Route::resource('contactlog','ContactLogController',
		['except' => 'destroy']);
	Route::resource('contacts'	,'ContactsController',
		['except' => ['index','create','store']]);
	Route::resource('people'	,'PeopleController');
	Route::resource('schools'	,'SchoolsController',
		['except' => ['edit','update','destroy']]);
	Route::resource('users'		,'UsersController');
	
	/**
	 * Adding contacts, format post(resourcename/{modelname}/addcontact)
	 */
	Route::post('schools/{schools}/addcontact','SchoolsController@addContact');


	/**
	 * Access to the contactlog, format get(resourcename/{modelname}/contactlog)
	 */
	Route::get('schools/{schools}/contactlog','SchoolsController@getContactlog');
	Route::get('schools/{schools}/getperson','SchoolsController@getPersons');



	// JSON-DataTables: /data/~
	Route::group(['prefix' => 'data'], function()
	{
		//Add: middleware with Request::ajax() --> Check if request is an Ajax-request.
		Route::get('schools'	,'SchoolsController@getData');
		Route::get('people'		,'PeopleController@getData');
		Route::get('contactdetails','ContactdetailsController@getData');
		Route::get('contactlog'	,'ContactLogController@getData');
		Route::get('contactnames','ContactsController@getNames');
	});




});

