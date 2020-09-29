<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
   protected $guarded=[];

    public function question_papers()
    {
        return $this->hasMany('App\QuestionPaper', 'q_number');
    }
}
