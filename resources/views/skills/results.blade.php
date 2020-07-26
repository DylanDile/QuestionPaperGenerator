@extends('layouts.app')

@section('content')
<div class="container">
<div class="text-center">
   <center><h4>My Test Results</h4></center>  
   <div class="table table-responsive table-striped">
      <table>
        <thead>
          <th>Test ID</th>
          <th>Question No..</th>
          <th>Result</th>
        </thead>
        <tbody>
          @foreach($results as $result)
           <tr>
             <td>{{ $result->test_id }}</td>
             <td>{{ $result->q_number }}</td>
             <td>
               @if($result->isCorrect == 1)
                  <img src="/images/ok.png" width="40%" height="40%">
               @else
                  <img src="/images/cancel.png" width="40%" height="40%">
               @endif       
             </td>
             
           </tr>
          @endforeach
          
        </tbody>
      </table>
  </div>
</div>
</div>
@endsection
