<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\Question;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $questions;
        if (auth::user()->isAdmin) {
            $questions = Question::query()->get();
            //$questions = DB::statement("SELECT * FROM questions ORDER BY RAND() LIMIT 10 ");

        }
        elseif (!auth::user()->isAdmin) {
            # code...
            $questions = Question::query()->where('q_trade', auth::user()->trade)->get();

        }
       
        return view('home')->with('questions', $questions);
    }

    public function multipleChoice()
    {
        $questions;
        if (auth::user()->isAdmin) {
            $questions = Question::query()->where('q_type', 'multiple_choice')->get();

        }
        elseif (!auth::user()->isAdmin) {
            # code...
            $questions = Question::query()->where('q_type', 'multiple_choice')->where('q_trade', auth::user()->trade)->get();

        }
       
        return view('questions.multipleChoice')->with('questions', $questions);
    }

    public function structured()
    {
        $questions;
        if (auth::user()->isAdmin) {
            $questions = Question::query()->where('q_type', 'structured')->get();

        }
        elseif (!auth::user()->isAdmin) {
            # code...
            $questions = Question::query()->where('q_type', 'structured')->where('q_trade', auth::user()->trade)->get();

        }
       
        return view('questions.structured')->with('questions', $questions);
    }

    public function searchStructured(Request $request)
    {
         $questions = DB::select("select * from questions
             where q_subject like '%".$request->input('q_subject')."%' 
             and q_trade = '".$request->input('q_trade')."'
             and q_chapter like '%".$request->input('q_chapter')."%' 
             and q_type = 'structured' ");


          return view('questions.structured')->with('questions', $questions);
    }
    

    public function searchMultipeChoice(Request $request)
    {
         $questions = DB::select("select * from questions
             where q_subject like '%".$request->input('q_subject')."%' 
             and q_trade = '".$request->input('q_trade')."'
             and q_chapter like '%".$request->input('q_chapter')."%' 
             and q_type = 'multiple_choice' ");


          return view('questions.multipleChoice')->with('questions', $questions);
    }
}
