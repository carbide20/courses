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

		echo Auth::id();
		$courses = Course::where('instructor_id', '=', Auth::id());
		
		foreach($courses as $course) {
			echo $course->title;
		}
        return view('home')->with('courses', $courses);

    }
}
