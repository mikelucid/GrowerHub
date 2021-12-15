<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $questions = Question::with(['answers.user', 'answers' => function ($query) {
		    $query->orderBy('votes_count', 'DESC');
	    }])->paginate(10) ?? abort(404);

        return view('questions.index')->with(compact('questions'));
    }
}
