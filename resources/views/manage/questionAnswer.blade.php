@extends('layouts.app')

@section('content')
<div class="container">   
    <div class="card-info float-md-none">
        <div class="card-header">
            <h4>Question Number : {{ $question->q_number }}</h4>
        </div>
        <div class="card-body">
            <p>
                <h5>Question: <b> {{ $question->question }}</b></h5>
                <hr>               
                @php
                    $type = $question->q_type;
                @endphp
                @if($type == 'multiple_choice')
                 <h5> <u>Possible Answers :</u></h5>
                    @php
                        $arrayAnswers = json_decode($answer->all_answers);
                    @endphp
                    {{-- Answer for A --}}
                    @if('A'  == trim($answer->q_answer) )  
                        <b class="text-success"> A: {{ $arrayAnswers->A }} </b> <br>
                    @else 
                        A: {{ $arrayAnswers->A }} <br>
                    @endif
                    {{-- Answer for B --}}
                    @if('B'   == trim($answer->q_answer) )  
                        B:<b class="text-success"> {{ $arrayAnswers->B }} </b> <br>
                    @else 
                        B: {{ $arrayAnswers->B }} <br>
                    @endif
                    {{-- Answer for C --}}
                    @if('C'   == trim($answer->q_answer) )  
                        C:<b class="text-success">{{ $arrayAnswers->C }}</b><br>
                    @else 
                        C: {{ $arrayAnswers->C }} <br>
                    @endif
                    {{-- Answer for D --}}
                    @if('D'   == trim($answer->q_answer) )  
                        D:<b class="text-success">{{ $arrayAnswers->D }} </b> <br>
                    @else 
                        D: {{ $arrayAnswers->D }} <br>
                    @endif  
                    <br>
                    <hr>             
                                      
                   <u><h6>Correct Answer </h6></u>
                    <p class="text-primary"><b>{{ $answer->q_answer }}</b></p>
                    {{-- @foreach($arrayAnswers as $ans )
                        {{ $ans}}
                    @endforeach --}}

                @elseif($type == 'structured')
                 <h5> <u>Answer :</u></h5>
                    <textarea readonly="" class="form-control">{{ $answer->q_answer }}</textarea>
                @endif
            </p>
        </div>
    </div>

</div>
@endsection
