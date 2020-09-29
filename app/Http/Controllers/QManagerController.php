<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\QuestionPaper;
use App\Question;
use App\Answer;
use DB;
use Log;
class QManagerController extends Controller
{  

    public function questionAnswer($q_number)
    {
        $question = Question::query()->where('q_number', $q_number)->first();
        $answer = Answer::query()->where('q_number', $q_number)->first();
        return view('manage.questionAnswer')->with('answer',$answer)->with('question', $question);
    }

    public function questionManage($q_number)
    {
        $question = Question::query()->where('q_number', $q_number)->first();
        $answer = Answer::query()->where('q_number', $q_number)->first();
        return view('manage.questionManage')->with('answer',$answer)->with('question', $question);

    }

    public function genMultipleChoice()
    {
        return view('manage.genMultipleChoice');
    }

    public function genMultipleChoiceSubmit(Request $request)
    {
         $questions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers from questions q, answers a 
             where q.q_trade = '".$request->input('q_trade')."'
             and q.q_level like '%".$request->input('q_level')."%' 
             and q.q_class like '%".$request->input('q_class')."%' 
             and q.q_type = 'multiple_choice' 
             and q.q_number = a.q_number ORDER BY RAND() LIMIT 20 ");

         $strQuestions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers from questions q, answers a  
            where q.q_trade = '".$request->input('q_trade')."'
            and q.q_level like '%".$request->input('q_level')."%'              
            and q.q_class like '%".$request->input('q_class')."%'
            and q.q_type = 'structured' 
            and q.q_number = a.q_number ORDER BY RAND() LIMIT 10 ");
        
         return view('papers.generalPaper')
            ->with('questions', $questions)
            ->with('strQuestions', $strQuestions)
            ->with('trade', $request->input('q_trade'))
            ->with('subject', $request->input('q_subject'))
            ->with('class', $request->input('q_class'));
    }

    public function generatePaper(Request $request)
    {
        $trade =  $request->input('q_trade');
        $subject =  $request->input('q_subject');
        $class =  $request->input('q_class');

         $questions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers from questions q, answers a 
             where q.q_trade = '".$request->input('q_trade')."'
             and q.q_level like '%".$request->input('q_level')."%' 
             and q.q_class like '%".$request->input('q_class')."%' 
             and q.q_type = 'multiple_choice' 
             and q.q_number = a.q_number ORDER BY RAND() LIMIT 20 ");

         $strQuestions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers from questions q, answers a  
            where q.q_trade = '".$request->input('q_trade')."'
            and q.q_level like '%".$request->input('q_level')."%'              
            and q.q_class like '%".$request->input('q_class')."%'
            and q.q_type = 'structured' 
            and q.q_number = a.q_number ORDER BY RAND() LIMIT 10 ");


        $qpnumber  = $this->addQuestionPaperToDB($questions, $strQuestions,$trade, $class);

        return redirect()->back()->with('success', "Question Paper generated successfully: Question Paper Number is ".$qpnumber);

        $pdf = \PDF::loadView('papers.generalPaper', compact('questions', 'strQuestions', 'trade', 'subject', 'class') );
        // If you want to store the generated pdf to the server then you
      /*  //can use the store function
        $pdf->save(storage_path().'_filename.pdf');*/
        // Finally, you can download the file using download function
        return $pdf->download('questionPaper.pdf');
    }

    public function addQuestionPaperToDB($questions, $strQuestions, $trade, $class)
    {
        $qpnumber = random_int(100000 , 999999).$trade.$class;
        foreach ($questions as $question) {
            # code...
            QuestionPaper::query()->create([
                'qp_title' => $trade. " ".$class,
                'qp_number' => $qpnumber,
                'questionsNum' => $question->q_number,
                'qp_class' => $class,
                'q_type' => 'multiple_choice',
                'qp_status' => 'new',
            ]);

        }
        foreach ($strQuestions as $q) {
            # code...
            QuestionPaper::query()->create([
                'qp_title' => $trade. " ".$class,
                'qp_number' => $qpnumber,
                'questionsNum' => $q->q_number,
                'qp_class' => $class,
                'q_type' => 'structured',
                'qp_status' => 'new',
            ]);

        }

        return  $qpnumber;

    }

    public function ImportFromExcel()
    {
        $file_path = base_path('public/uploads/questions.csv');
        $counter = 14;
        $lines = file($file_path ,  FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $key => $line) {

            if ($key === 0) {
                continue;
            }

            $array = explode(",", $line);
            list(
                $qNum, 
                $trade, 
                $subject, 
                $question, 
                $chapter, 
                $weight,
                $level,
                $class, 
                $type, 
                $status, 
                $correct_answer,
                $a,
                $b,
                $c,
                $d
             ) = $array;

           /* Log::info(
                $array[0].
                $array[1]
            );*/

            Log::info($qNum. ' is '.$type);
            /** @var Payment $p */
            $p =  Question::query()->create(
                [
                    'q_number' =>  $qNum,
                    'q_trade' =>  $trade,
                    'q_subject' =>  $subject,
                    'question' =>  $question,
                    'q_chapter' => $chapter,
                    'q_weight' =>  $weight,
                    'q_level' => $level,
                    'q_class'=>  $class,
                    'q_type'=>  $type,
                    'q_status' => 'on',
                ]
            );

            if ($type == 'structured') {
                # code...
                 $a = Answer::query()->create([
                    'q_number'  => $qNum,
                    'q_answer' => $correct_answer,
                    'all_answers' => $correct_answer,
                    'a_status' => 'correct',
                    'created_at'  => now(),
                    'updated_at' => now(),
                ]);
            }
           elseif ($type == 'multiple_choice') {
               # code...
                $all_answers = array(
                    'A' => $a, 
                    'B' => $b, 
                    'C' => $c, 
                    'D' => $d, 
                );
                $jsonAnswers = json_encode($all_answers);
                $a = Answer::query()->create([
                    'q_number'  => $qNum,
                    'q_answer' => $correct_answer,
                    'all_answers' => $jsonAnswers,
                    'a_status' => 'correct'
                ]);
           }

            
        }

        return redirect()->back()->with('success', "Questions imported successfully");
    }

    public function viewGeneratedPapers()
    {
        $question_papers =  QuestionPaper::query()->distinct()->get(['qp_number', 'qp_title', 'qp_class']);
        return view('questions.generatedPapers')->with('question_papers', $question_papers);
    }

    public function viewPaper($qp_number)
    {
        $paper =  QuestionPaper::query()->distinct()->where('qp_number', $qp_number)->get(['qp_number', 'qp_title', 'qp_class']);
        $strQuestions = QuestionPaper::query()->where('q_type', 'structured')->where('qp_number', $qp_number)->get();
        $mulQuestions = QuestionPaper::query()->where('q_type', 'multiple_choice')->where('qp_number', $qp_number)->get();
       /* Log::info($paper);
        Log::info($strQuestions);
        Log::info($mulQuestions);*/
        return view('papers.viewGenPaper')->with('strQuestions', $strQuestions)
                                          ->with('mulQuestions', $mulQuestions)
                                          ->with('paper', $paper);
    }
}
