<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use DB;
use Auth;

class QuestionsController extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $questions;
        if (auth::user()->isAdmin) {
            $questions = Question::query()->get();
        }
        elseif (!auth::user()->isAdmin) {
            # code...
            $questions = Question::query()->where('q_trade', auth::user()->trade)->get();
        }
       
        return view('admins.allQuestions')->with('questions', $questions);
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function addMultipleChoiceQuestion()
    {
        $lastNumber;
        $lastQ = Question::query()->orderBy('q_number', 'desc')->first();
        if ($lastQ) {
            # code...
            $lastNumber = $lastQ->q_number + 1;
        }
        else
        {
            $lastNumber = 1;
        }       

        return view('admins.addMutlipleChoiceQuestion')->with('lastNumber', $lastNumber);
    }

    public function addStructuredQuestion()
    {
        $lastNumber;
        $lastQ = Question::query()->orderBy('q_number', 'desc')->first();
        if ($lastQ) {
            # code...
            $lastNumber = $lastQ->q_number + 1;
        }
        else
        {
            $lastNumber = 1;
        }       

        return view('admins.addStructuredQuestion')->with('lastNumber', $lastNumber);
    }

    public function addQuestionStore(Request $request)
    {
        $this->validate($request, [           
           'q_number' => 'required|min:1, max:20',
           'q_subject' => 'required|min:3, max:100',
           'question' => 'required|min:4',
           'q_chapter' => 'required|min:1,',           
           'q_weight' => 'required|min:1',
           'q_level' => 'required',
           'q_cls' => 'required',
           'q_trade' => 'required',
           /*'a_answer' => 'required|min:1',
           'b_answer' => 'required|min:1',
           'c_answer' => 'required|min:1',
           'd_answer' => 'required|min:1',*/
        ]);

        /* 'q_image' => 'required|mimes:.jpg, .jpeg, .png',*/

       $question_type = $request->input('q_type');
       $newQuestion = Question::query()->create([

            'q_number' =>  $request->input('q_number'),
            'q_trade' =>  $request->input('q_trade'),
            'q_subject' =>  $request->input('q_subject'),
            'question' =>  $request->input('question'),
            'q_chapter' => $request->input('q_chapter'),
            'q_weight' =>  $request->input('q_weight'),
            'q_level' => $request->input('q_level'),
            'q_class'=>  $request->input('q_cls'),
            'q_type'=>  $request->input('q_type'),
            'q_status' => 'on',
        ]);
        $answers;
        if($question_type == 'multiple_choice')
        {
          $answers = array(
            'A' => $request->input('a_answer') , 
            'B' => $request->input('b_answer') , 
            'C' => $request->input('c_answer') , 
            'D' => $request->input('d_answer')
             );

       
        }
        elseif ($question_type == 'structured') 
        {
          # code...
          $answers = array('answer' => $request->input('correct_answer'));

        }
        
        $jsonAnswers = json_encode($answers);

        $answer = new Answer();
        $answer->q_number = $request->input('q_number');
        $answer->q_answer = $request->input('correct_answer');
        $answer->all_answers = $jsonAnswers;
        $answer->a_status = 'correct';
        $answer->save();

        if($newQuestion)
        {
           return redirect()->back()->with('success', "Question added successfully");           
        }
        else
        {
            return redirect()->back()->with('error', "Failed to add question.");            
        }               
        
    }

    public function searchQuestions(Request $request)
    {

        $questions = DB::select("select * from questions  where q_subject like '%".$request->input('subject')."%' and q_chapter like '%".$request->input('chapter')."%' ");
        return view('home')->with('questions', $questions);
    }
}
