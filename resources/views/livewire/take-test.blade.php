<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
      <script type="text/javascript">
      window.onload=counter;
      function counter()
      {
        minutes={{ $minute }};
        seconds ={{ $second }};
        countDown();
      }
    </script>
    <script type="text/javascript">
      function countDown(){
      document.getElementById("min").innerHTML= minutes;
      document.getElementById("remain").innerHTML= seconds;
      setTimeout("countDown()",1000);
        if(minutes == 0 && seconds == 0)
          {            
            document.getElementById("status").innerHTML= "Test over";          
            myFunction();
          }
        else  
          {
	          seconds--;  
	          if(seconds ==0 && minutes > 0)
	          {
	            minutes--;
	            seconds=60;
	          }
          }
      }
      function myFunction() {
        //document.write("Done");
        document.getElementById("testForm").submit();
        //document.testForm.submit();
        //document.form['testForm'].submit();
      }
</script>
<script>

	Livewire.on('examTimeElapses',
	    
	);
</script>

</head>
<body>
<div class="container  bg-white"> 
	<div>
      @if (session()->has('success'))
          <div class="alert alert-success p-3 bg-green-300 ">
              {{ session('success') }}
          </div>
      @endif
      @if (session()->has('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif
  </div>
	<div class="text-danger float-right">
      <b>You have:</b>
      <span id="min" ></span> <b>Minutes</b>
      <span id="remain"></span> <b>Seconds</b>
   </div>
   <h1 class="text-danger"><span id="status"></span></h1>
<div class="bg-white text-center">
    <p>
        <center>
        <h3>
            Ministry of Higher and Tertiary Education, Innovation <br>
            Science and Technology Dvelopment <br>
            Industrial Training anf Trade Testing Department <br>                     
        </h3>
        <br>
       {{--  <img src="{{ public_path('/images/ministry.png') }}" width="20%" height="15%"> <br> --}} 
        <img src="/images/ministry.png" width="20%" height="15%"> <br> 
        <h4>ZIMBABWE</h4>
        <h3 class="text-capitalize" > {{ $paper[0]->qp_title }}</h3>
        <h5>{{ "" }}</h5>
        <br>
        <h5><b>Class : {{ $paper[0]->qp_class }}</b></h5>
        <h5><u>Theory Trade Test</u></h5>
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

<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#home">Section A</a>
  </li>
  <li class="nav-item">
    <a class="nav-link " data-toggle="tab" href="#profile">Section B</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#finish">Finish Test</a>
  </li>

</ul>
<form id="testForm" method="post" action="{{ route('student.trade_test.submit') }}">
	@csrf
<div id="myTabContent" class="tab-content">
{{-- Mutliple Questions --}}
  <div class="tab-pane fade active show" id="home">
   	<h4> <u>Section A</u></h4>
    <h5> <b>Multiple Choice Questions</b></h5>
    <hr>       
     <div>
        @php
        	$counter=0;
        @endphp
        @foreach($mulQuestions as $mulQuestion)
            <div class="col-sm-10">
                <h4>Question No.: <b>@php
                    $counter+=1;
                    echo $counter;
                @endphp</b></h4>
                <p>{{ $mulQuestion->question }} <b class="text-right float-right">[{{ $mulQuestion->q_weight }}]</b> </p>
                @php
                    $arrayAnswers = json_decode($mulQuestion->all_answers);                        
                @endphp
               <h4><b> <u>Answers :</u></b></h4>
                    A: {{ $arrayAnswers->A }} <br>
                    B: {{ $arrayAnswers->B }} <br>
                    C: {{ $arrayAnswers->C }} <br>
                    D: {{ $arrayAnswers->D }} <br>

                <h5><u><b>Select Answer</b></u></h5>                
              
                <input type="hidden" name="q_number@php echo $counter; @endphp" value="{{ $mulQuestion->q_number }}">
                <div class="form-group row text-center " style="margin-left: 20%;">
                   <b style="font-size: 15px; margin-left: 0%; ">A</b>
                   <input wire:model.lazy="answer@php echo $counter; @endphp"  type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="A">
                   <b style="font-size: 15px; margin-left: 0%; ">B</b>
                   <input wire:model.lazy="answer@php echo $counter; @endphp" type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="B">
                   <b style="font-size: 15px; margin-left: 0%; ">C</b>
                   <input wire:model.lazy="answer@php echo $counter; @endphp" type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="C">
                   <b style="font-size: 15px; margin-left: 0%; ">D</b>
                   <input wire:model.lazy="answer@php echo $counter; @endphp"type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="D">
                </div>
                    <hr>  

            </div>
        @endforeach

        </div>
</div>
 {{-- End multiple questions --}}
 {{-- Structured Questions --}}
  <div class="tab-pane fade" id="profile">
    <h4> <u>Section B</u></h4>
        <h5> <b>Structured Questions</b></h5>
        @php
        	$strCounter =0;
        @endphp       
        <div>
            @foreach($strQuestions as $strQuestion)
                <div class="col-sm-10">
                    <h4>Question No.: <b>@php
                        $counter+=1;
                        $strCounter+=1;
                        echo $counter;
                    @endphp</b></h4>
                    <input type="hidden" name="str_q_number@php echo $strCounter; @endphp" value="{{ $strQuestion->q_number }}">
                    <p>{{ $strQuestion->question }} <b class="text-right float-right">[{{ $strQuestion->q_weight }}]</b></p> 
                    <textarea class="form-control" wire:model.lazy="str_answer@php echo $strCounter; @endphp" name="str_answer@php echo $strCounter; @endphp" rows="9" placeholder="Your answer here"></textarea>                   
                    <hr>
                </div>
            @endforeach
        </div>       
  </div>
  {{-- End structured questions --}}
  <div class="tab-pane fade" id="finish">
  	<h4 class="text-warning">If you are sure you are done with you test please </h4>
    <input type="submit" class="btn btn-success form-control" name="submitTest" value="Submit Your Test">
  </div>
</div>
</form>
</div>
