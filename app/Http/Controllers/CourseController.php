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

	/**
	 * Handles creation of new courses
	 * @param Request $request
	 * @return mixed
	 */
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
				$course->description = $formdata['description'];
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


		}

		// Redirect the user back to their homepage with a failure message
		return Redirect::to('/home')->with('error', 'Please fill out all required fields and try again');

	}


	/**
	 * Handles populating and rendering the course edit page
	 * @param $id
	 * @return $this
	 */
	public function edit($id) {

		// Make sure the user is still logged in, and we have a course ID to edit
		if (Auth::check() && $id > 0) {

			// Look up the course being edited
			$course = Course::find($id);

			// Ensure that this course exists, and belongs to this user
			if ($course && $course->instructor_id == Auth::id()) {

				// Break the start datetime into date and time
				$course['start_date'] = date('Y-m-d', strtotime($course['start']));
				$course['start_time'] = date('H:i:s', strtotime($course['start']));

				// Break the end datetime up into date and time
				$course['end_date'] = date('Y-m-d', strtotime($course['end']));
				$course['end_time'] = date('H:i:s', strtotime($course['end']));


				return view('course.edit')->with('course', $course);

			}

		}

		// Redirect the user back to their homepage with a success message
		return Redirect::to('/home')->with('success', 'Course updated successfully');


	}


	/**
	 * Processes postdata when a user updates a course
	 * @param Request $request
	 * @param $id
	 * @return mixed
	 */
	public function update(Request $request, $id) {

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

				// Look up the course being edited
				$course = Course::find($id);

				// Ensure that this course exists, and belongs to this user
				if ($course && $course->instructor_id == Auth::id()) {

					// Apply the formdata to the new course
					$course->title = $formdata['title'];
					$course->description = $formdata['description'];
					$course->start = $formdata['start_date'] . ' ' . $formdata['start_time'];
					$course->end = $formdata['end_date'] . ' ' . $formdata['end_time'];
					$course->price = $formdata['price'];
					$course->total_slots = $formdata['total_slots'];
					$course->instructor_id = Auth::id();

					// Create the new course
					$course->save();

					// Redirect the user back to their homepage with a success message
					return Redirect::to('/home')->with('success', 'Course updated successfully');

				}

			}


		}

		// Redirect the user back to their homepage with a failure message
		return Redirect::to('/home')->with('error', 'Please fill out all required fields and try again');

	}


	/**
	 * Handles course deletion
	 * @param $id
	 * @return mixed
	 */
	public function delete($id) {

		// Make sure we have an active user
		if (Auth::check()) {

			// Look up the course being deleted
			$course = Course::find($id);

			// Ensure that this course exists, and belongs to this user
			if ($course && $course->instructor_id == Auth::id()) {

				// Delete the course
				$course->delete();

				// Redirect the user back to their homepage with a success message
				return Redirect::to('/home')->with('success', 'The course was deleted successfully');

			}

		}

		// Redirect the user back to their homepage with a success message
		return Redirect::to('/home')->with('error', 'Please ensure you are logged in and try again');

	}

}