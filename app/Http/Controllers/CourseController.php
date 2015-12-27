<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class CourseController extends Controller
{
	public function create(Request $request) {

		// Make sure that the all required fields are present
		if (
			$request->has('title')
			&& $request->has('description')
			&& $request->has('start_date')
			&& $request->has('start_time')
			&& $request->has('end_date')
			&& $request->has('end_time')
			&& $request->has('price')
			&& $request->has('total_slots')
		) {

			// Make sure we have an active user
			if (Auth::check()) {

				// Retrieve the formdata from the request
				$formdata = $request->all();

				// Create a new course to fill with this info
				$course = new Course;

				// Apply the formdata to the new course
				$course->title = $formdata['title'];
				$course->description = $formdata['title'];
				$course->start = $formdata['start_date'] . ' ' . $formdata['start_time'];
				$course->end = $formdata['end_date'] . ' ' . $formdata['end_time'];
				$course->price = $formdata['price'];
				$course->total_slots = $formdata['total_slots'];
				$course->instructor_id = Auth::id();

				// Create the new course
				$course->save();

				// Redirect the user back to their homepage with a success message
				return Redirect::to('/home')->with('success', 'Course created successfully');

			}


		} else {

			// Redirect the user back to their homepage with a failure message
			return Redirect::to('/home')->with('error', 'Please fill out all required fields and try again');

		}


		// Validate the input for this class


	}

}