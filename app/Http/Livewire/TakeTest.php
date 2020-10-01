<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\TradeTest;
use App\QuestionPaper;
use Log;
use DB;

class TakeTest extends Component
{
	public $qp_number;
	public $mulQuestions;
	public $strQuestions;
	public $paper;
	public $minute;
	public $second;
	public $state;
	public $test_over;

	public $answer1;
	public $answer2;
	public $answer3;
	public $answer4;
	public $answer5;
	public $answer6;
	public $answer7;
	public $answer8;
	public $answer9;
	public $answer10;
	public $answer11;
	public $answer12;
	public $answer13;
	public $answer14;
	public $answer15;
	public $answer16;
	public $answer17;
	public $answer18;
	public $answer19;
	public $answer20;


	public $str_answer1;
	public $str_answer2;
	public $str_answer3;
	public $str_answer4;
	public $str_answer5;
	public $str_answer6;
	public $str_answer7;
	public $str_answer8;
	public $str_answer9;
	public $str_answer10;

	protected $listeners = ['examTimeElapses'];

	public function mount($qp_number)
	{
		$this->minute =0;
		$this->state =0;
		$this->second = 60;
	    $this->qp_number = $qp_number;

	    $this->paper =  QuestionPaper::query()->distinct()->where('qp_number', $qp_number)->get(['qp_number', 'qp_title', 'qp_class']);

        $this->mulQuestions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers 
            from questions q, answers a , question_papers qp           
            where q.q_type = 'multiple_choice' 
            and q.q_number = qp.questionsNum
            and q.q_number = a.q_number
            and qp.qp_number = '".$qp_number."' 
            ");

         $this->strQuestions = DB::select("select q.q_number, q.question, q.q_weight , a.all_answers 
            from questions q, answers a  , question_papers qp
            where q.q_number = qp.questionsNum           
            and q.q_type = 'structured' 
            and q.q_number = a.q_number 
            and qp.qp_number = '".$qp_number."'
            ");

	}

    public function render()
    {
        return view('livewire.take-test');
    }

    public function submitTest()
    {
    	dd("Test submitted");
        session()->flash('success', 'Test has been submitted.');
    }

    public function examTimeElapses()
    {
        $this->state = 30;
    }

    public function updated($field)
    {
    	session()->flash('error', 'Failed to add content.');
        if($this->test_over == 100)
        {
        	session()->flash('error', 'Failed to add content.');
        }
    }

}
