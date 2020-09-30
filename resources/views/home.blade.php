@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
<div class="container">
@if(auth::user()->isAdmin)
<div class="">
    <h4>All Questions</h4>
    <form action="{{ route('admin.searchQuestion') }}" method="post">
        @csrf
         <div class="form-group row">
            <label for="subject" class="col-md-2 col-form-label text-md-right">{{ __('Search Questions') }}</label>
            <div class="col-md-4">
                <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" autocomplete="subject" autofocus placeholder="subject">
            </div>
            <div class="col-md-4">
                <input id="chapter" type="text" class="form-control @error('chapter') is-invalid @enderror" name="chapter" value="{{ old('chapter') }}" autocomplete="chapter" autofocus placeholder="chapter">                
            </div>
            <div class="col-md-">
                <input type="submit" name="search" value="Search" class="btn btn-info">              
            </div>
        </div> 
    </form>
    <div class="table">
        <table class="table-responsive table-striped" width="100%" id="questions">
            <thead>
                <th>QNo..</th>
                <th>Subject</th>
                <th>Question</th>
                <th>Chapter</th>
                <th>Weight</th>
                <th>Level</th>
                <th>Class</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </thead>
            <tbody>
                @php
                    $counter = 0;
                @endphp
                @foreach($questions as $question)
                <tr>
                    <td>@php
                        $counter += 1;
                        echo $counter;
                    @endphp</td>
                    <td>{{ $question->q_subject }}</td>
                    <td>{{ $question->question }}</td>
                    <td>{{ $question->q_chapter }}</td>
                    <td>{{ $question->q_weight }}</td>
                    <td>{{ $question->q_level }}</td>
                    <td>{{ $question->q_class }}</td>
                    <td>{{ $question->q_type }}</td>
                    <td>{{ $question->q_status }}</td> 
                    <td>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/admin/answer/{{ $question->q_number }}"><i class="custom-badge status-blue fa fa-refresh m-r-5">&nbsp;Answer</i></a>
                                @if(auth::user()->isAdmin)
                                <a class="dropdown-item" href="/admin/manage/{{ $question->q_number }}"><i class="custom-badge status-red fa fa-refresh m-r-5">&nbsp;Manage</i></a>
                                @endif
                            </div>
                        </div>
                    </td>                   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<h3>Trade Tests Exam Sitting and Marking System</h3>
</div>
@endsection
@section('javascripts')
    <script src=" https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src=" https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src=" https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.4.2/js/buttons.print.js"></script>
    <script src=" https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#questions').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    'pageLength','colvis',
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, ':visible' ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        filename: 'questions',
                        title:'Questions Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3,4,5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'print',
                        orientation:'landscape',
                        title:'Questions Report',
                        exportOptions: {
                            columns: [0, 1, 2, 3 ,4,5, 6, 7, 8]
                        }
                    }
                ]
            } );
        } );
    </script>
@endsection
