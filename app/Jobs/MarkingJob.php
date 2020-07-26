<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Question;
use App\Answer;
use App\Test;
use DB;

class MarkingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user_id;
    protected $arrayAnswers;
    protected $testID;

    public function __construct($user_id, $arrayAnswers , $testID)
    {
        $this->user_id = $user_id;
        $this->arrayAnswers = $arrayAnswers;
        $this->testID = $testID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $answered = 0;
        $correct = 0;
        $wrong  = 0;

        foreach ($this->arrayAnswers as $value) {
            # code...  
            if ($value['answer'] != null) {
                # code...
                $answered += 1;             
            }

            $qNumber = $value['question'];
            $qAnswer = $value['answer'];

            $checkAnswer = Answer::query()->where('q_number', $qNumber)->first();
            $correctAnswer = $checkAnswer->q_answer;

            if($correctAnswer == $qAnswer)
            {
                $correct += 1;
                DB::insert('insert into test_answers (test_id, q_number, isCorrect) values (?, ?, ?)', [$this->testID , $qNumber , 1]);
            }
            else
            {
                $wrong += 1;
                DB::insert('insert into test_answers (test_id, q_number, isCorrect) values (?, ?, ?)', [$this->testID , $qNumber , 0]);
            }

            
        }

        $remaining = 10 - $answered;
        $percentage = ($correct/10) * 100;
        $status;
        if($remaining == 0)
        {
            $status = 'completed';
        }
        else
        {
            $status = 'not_complete';
        }

        Test::query()->create([
            'test_id'  => $this->testID,
            'user_id'  =>  $this->user_id,
            'answered'  => $answered,
            'remaining'  => $remaining,
            'total'  => 10,
            'correct'  => $correct,
            'wrong'  => $wrong,
            'percentage'  => $percentage,
            'questions'  => json_encode($this->arrayAnswers),
            'status'  => $status,
        ]);


    }
}
