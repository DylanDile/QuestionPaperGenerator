<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<div class="container  bg-white"> 
<div class="bg-white text-center">
    <p>
        <center>
        <h3>
            Ministry of Higher and Tertiary Education, Innovation <br>
            Science and Technology Dvelopment <br>
            Industrial Training anf Trade Testing Department <br>                     
        </h3>
        <br>
        <img src="{{ public_path('images/ministry.png') }}" width="20%" height="15%"> <br> 
       {{--  <img src="/images/ministry.png" width="20%" height="15%"> <br>  --}}
        <h4>ZIMBABWE</h4>
        <h3 class="text-capitalize" > {{ $trade }}</h3>
        <h5>{{ $subject }}</h5>
        <br>
        <h5><b>Class : {{ $class }}</b></h5>
        <h5><u>Theory Test</u></h5>
        </center>
    </p>
    <hr>


    <p class="text-left">
      <label><b>Instructions to candidate :</b></label> <br>
       <p class="text-left">
           <ul class="text-left">
               <li>Write your Candidate Number on all your loose sheets in the booklet provided as given on the Multiple Choice Answer Sheet.</li>
               <li>Check if all your test papers are complete</li>
               <li>Attempt all questions</li>
               <li>On multiple choice questions only one answer is correct. The marking has to be done carefully and <u><b>only in ink.</b></u>.</li>
           </ul>
       </p>
    </p>
    <hr>
    <p class="text-left">
        Time : <b> 2 hrs 30 mins </b> <br>
        Number of Questions: <b> 35 </b><br>
        Type of Questions :
         <ul class="text-left">
             <li> Multiple Choice : <b>20</b> </li>
             <li> Short Answers:    <b>10</b> </li>
             <li> Essay Type :<b>5</b></li>
         </ul> 

    </p>
    <br>
    <br>
    <br>
    <hr>
    <p class="text-right">
        @php
           $date = date('yy');
        @endphp
        <small><strong><i>Printed in : @php
            echo($date);
        @endphp</i></strong></small>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <small>Goodluck</small>

    </p>
</div> 

<br>
    <h4> <u>Section A</u></h4>
    <h5> <b>Multiple Choice Questions</b></h5>
    <hr>
    <div class="visible-print-block">
        {{-- Mutliple Questions --}}
        <div>
            @php
            $counter=0;
            @endphp
            @foreach($questions as $question)
                <div class="col-sm-10">
                    <h4>Question No.: <b>@php
                        $counter+=1;
                        echo $counter;
                    @endphp</b></h4>
                    <p>{{ $question->question }} <b class="text-right float-right">[{{ $question->q_weight }}]</b> </p>
                    @php
                        $arrayAnswers = json_decode($question->all_answers);
                    @endphp
                   <h4><b> <u>Answers :</u></b></h4>
                    A: {{ $arrayAnswers->A }} <br>
                    B: {{ $arrayAnswers->B }} <br>
                    C: {{ $arrayAnswers->C }} <br>
                    D: {{ $arrayAnswers->D }} <br>
                    <hr>
                </div>
            @endforeach
        </div>
        {{-- End multiple questions --}}

        <h4> <u>Section B</u></h4>
        <h5> <b>Structured Questions</b></h5>
        {{-- Structured Questions --}}
        <div>
            @foreach($strQuestions as $strQuestion)
                <div class="col-sm-10">
                    <h4>Question No.: <b>@php
                        $counter+=1;
                        echo $counter;
                    @endphp</b></h4>
                    <p>{{ $strQuestion->question }} <b class="text-right float-right">[{{ $question->q_weight }}]</b></p>                    
                    <hr>
                </div>
            @endforeach
        </div>
        {{-- End structured questions --}}
    </div>
</div>
</body>
</html>

