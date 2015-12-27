<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::auth();

    Route::get('/home', 'HomeController@index');

	// Course editing route
	Route::get('course/edit/{id}', array('as' => 'course.edit', function($id)
	{
		// return our view and Course information
		return View::make('course-edit') // pulls app/views/course-edit.blade.php
		->with('course', Course::find($id));

	}));

	// Course editing
	Route::post('course/edit', 'CourseController@edit');


	// Course creation
	Route::post('course/create', 'CourseController@create');

});







