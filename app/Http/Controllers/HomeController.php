<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\Course;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {

		// Get an array of courses which this instructor has created
		$courses = Course::where('instructor_id', '=', Auth::id())->get();

		// Render the view, passing the courses array into it
        return view('home')->with('courses', $courses);

    }
}
