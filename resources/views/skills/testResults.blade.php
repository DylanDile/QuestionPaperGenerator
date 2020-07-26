@extends('layouts.app')

@section('content')
<div class="container">
<center><h4>My Tests</h4></center>  
 <div class="table table-responsive">
    <table>
      <thead>
        <th>Test ID</th>
        <th>Answered</th>
        <th>Remained</th>
        <th>Correct</th>
        <th>Wrong</th>
        <th>Out Of</th>
        <th>%</th>
        <th>Status</th>
        <th>Date Taken</th>
        <th>Action</th>
      </thead>
      <tbody>
        @if(count($tests) > 0)
        @foreach($tests as $test)
         <tr>
           <td>{{ $test->test_id }}</td>
           <td>{{ $test->answered }}</td>
           <td>{{ $test->remaining }}</td>
           <td>{{ $test->correct }}</td>
           <td>{{ $test->wrong }}</td>
           <td>{{ $test->total }}</td>
           <td>{{ $test->percentage }}%</td>
           <td>{{ $test->status }}</td>
           <td>{{ $test->created_at }}</td>
           <td>
             <div class="dropdown dropdown-action">
                  <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                  <div class="dropdown-menu dropdown-menu-right">
                      <a class="dropdown-item" href="/student/test/answers/{{ $test->test_id }}"><i class="custom-badge status-blue fa fa-refresh m-r-5">&nbsp;Answers</i></a>
                  </div>
              </div>
           </td>
         </tr>
        @endforeach
        @else
          <tr>
            <td colspan="9"> You havent took any test yet.</td>
          </tr>
        @endif
      </tbody>
    </table>
 </div>
</div>
@endsection
