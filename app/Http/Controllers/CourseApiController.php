<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Redirect;

class CourseApiController extends Controller
{

	/**
	 * Lists all available courses for API calls
	 */
	public function index() {

		$courses = Course::all();
		echo json_encode($courses);

	}


}