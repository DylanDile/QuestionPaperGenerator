@extends('layouts.app')

@section('content')
<div class="container">  
  <script type="text/javascript">
      window.onload=counter;
      function counter()
      {
        minutes=00;
        seconds =10;
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
            /*document.form[0].submit();
            document.write("form submitted"); */
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
        //document.getElementById("testForm").submit();
        document.testForm.submit();
        document.form['testForm'].submit();
      }
</script>
 <div class="card">
   <div class="card-header">
      <h3><u> <b>Skills Test  </b>  </u></h3>
   </div>
   <div class="text-danger float-right">
      <b>You have:</b>
      <span id="min" ></span> <b>Minutes</b>
      <span id="remain"></span> <b>Seconds</b>
   </div>
   <div class="card-body">     
      <form id="testForm" name="testForm" action="{{ route('student.skillsTest.submit') }}" method="post">
          @csrf
        <div class="row">
          @php
            $counter=0;            
          @endphp
          @foreach($questions as $question)
            <div class="col-sm-10">
              <h4>Question No.: 
             <b>          
              @php
                $counter += 1;
                echo $counter;
              @endphp
              </b> 
            </h4>
              <p>{{ $question->question }} <b class="float-right"> [{{ $question->q_weight }}] </b></p>
              @php
                $arrayAnswers = json_decode($question->all_answers);
              @endphp
               <h4><b> <u>Answers :</u></b></h4>
                A: {{ $arrayAnswers->A }} <br>
                B: {{ $arrayAnswers->B }} <br>
                C: {{ $arrayAnswers->C }} <br>
                D: {{ $arrayAnswers->D }} <br>                

                <h5><u><b>Select Answer</b></u></h5>                
              
                <input type="hidden" name="q_number@php echo $counter; @endphp" value="{{ $question->q_number }}">
                <div class="form-group row text-center " style="margin-left: 20%;">
                   <b style="font-size: 15px; margin-left: 0%; ">A</b><input type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="A">
                   <b style="font-size: 15px; margin-left: 0%; ">B</b><input type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="B">
                   <b style="font-size: 15px; margin-left: 0%; ">C</b><input type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="C">
                   <b style="font-size: 15px; margin-left: 0%; ">D</b><input type="radio" name="answer@php echo $counter; @endphp" class="form-control col-sm-2" value="D">
                </div>                
                <hr>
        </div>
       @endforeach        
       </div>
       <div class="form-group">
           <input type="submit" name="submit" value="Submit Answers" class="btn btn-success text-right float-right" >
        </div>
      </form>
   </div>
 </div>
</div>

@endsection
