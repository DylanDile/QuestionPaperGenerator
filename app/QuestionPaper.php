<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionPaper extends Model
{
    //
    protected $guarded = [];

    public function questions()
    {
        return $this->belongsTo('App\Question', 'questionsNum');
    }

    public function answers()
    {
        return $this->belongsTo('App\Answer', 'questionsNum');
    }

}
