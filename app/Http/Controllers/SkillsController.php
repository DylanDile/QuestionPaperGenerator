<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Auth;
use DB;
use App\Test;
use App\Jobs\MarkingJob;
use Illuminate\Support\Str;

class SkillsController extends Controller
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
 
 	public function test()
 	{ 	
 		/*$questions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers from questions q, answers a where q.q_trade='".auth::user()->trade."'  and q.q_type = 'multiple_choice' and q.q_number = a.q_number ");
 		*/
 		$questions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers from questions q, answers a where q.q_type = 'multiple_choice' and q.q_number = a.q_number  ORDER BY RAND() LIMIT 10");
 		
 	    return view('skills.test')->with('questions', $questions);
 	}

 	public function testSubmit(Request $request)
 	{
 	    //simple way 
 	    $arrayAnswers = array();
 	   
 	    for ($i=1; $i < 11 ; $i++) { 
 	    	# code...
 	    	$ansAtNum = $request->input('answer'.$i.'');
 	    	$qusAtNum = $request->input('q_number'.$i.'');

 	    	$newArray = array('question' => $qusAtNum, 'answer' => $ansAtNum); 	    
 	    	$arrayAnswers += [$i => $newArray];	   	

 	    }  
 	   	
 	   	$testID = date('dmyyHs').auth::user()->id.Str::random(3); 	   	

 	    MarkingJob::dispatch(auth::user()->id, $arrayAnswers, $testID);

 	    return redirect()->back()->with('success', 'Dear Student. 
 	    	Your test has been submitted for marking check it out after a minute.!');
 	}

 	public function testResults()
 	{
 	    $id = auth::user()->id;
 	    $tests = Test::query()->where('user_id', $id)->get();

 	    return view('skills.testResults')->with('tests', $tests);
 	}

 	public function getResults($testID)
 	{
 	    $results = DB::select("select * from test_answers where test_id = '".$testID."' ");

 	    return view('skills.results')->with('results', $results);
 	}
}
