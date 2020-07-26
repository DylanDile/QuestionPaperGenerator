@extends('layouts.app')

@section('content')
<div class="container  bg-white">   
    <h3>Multiple Choice Paper</h3>
    <hr>
    <div class="visible-print-block">
    	@php
    		$counter=0;
    	@endphp
    	@foreach($questions as $question)
    		<div class="col-sm-10">
    			<h4>Question No.: <b>@php
    				$counter+=1;
    				echo $counter;
    			@endphp</b></h4>
    			<p>{{ $question->question }} [{{ $question->q_weight }}]</p>
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
</div>
@endsection
