@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
<div class="container  bg-white">  

    <div class="jumbotron bg-white">
        <div class="card">
            <div class="card-header">
                <h3>Scheduled Trade Test </h3>
            </div>
            <div class="card-body">

                 <div class="table table-responsive jumbotron bg-white justify-content-center">
                    <table class="table table-responsive table-striped" width="100%" id="question_papers">
                        <thead>
                            <th>Test ID.</th>
                            <th>QP Number</th>
                            <th>Exam Date</th>
                            <th>Exam Time</th>
                            <th>Class</th>
                            <th>Trade</th>

                            <th>Action</th>
                        </thead>
                        <tbody>
                            @php
                                $counter = 0;
                            @endphp
                            @foreach($trade_tests as $trade_test)
                            <tr>
                                <td>{{ $trade_test->id }}</td>
                                <td>{{ $trade_test->qp_number }}</td>
                                <td>{{ $trade_test->exam_date }}</td>
                                <td>{{ $trade_test->exam_time }}</td>
                                <td>{{ $trade_test->class }}</td>
                                <td>
                                    @php
                                       echo substr($trade_test->trade,0,-1)."<br>";
                                    @endphp
                                </td>
                                
                                <td>
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
    
                                            @if(auth::user()->isAdmin)
                                            <a class="dropdown-item" href="/admin/viewPaper/{{ $trade_test->qp_number }}"><i class="custom-badge status-blue fa fa-refresh m-r-5">&nbsp;View Paper</i></a>
                                            <a class="dropdown-item" href="/admin/delete/{{ $trade_test->id }}/test"><i class="custom-badge status-red fa fa-refresh m-r-5">&nbsp;Delete Test</i></a>
                                            @endif

                                            @php
                                                $today = date('Y-m-d');
                                            @endphp

                                            @if(!auth::user()->isAdmin && $today == $trade_test->exam_date)
                                            <a class="dropdown-item" href="/student/take/{{ $trade_test->id }}/test"><i class="custom-badge status-red fa fa-refresh m-r-5">&nbsp;Take Test</i></a>
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
        </div>
    </div>
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
            $('#trade_tests').DataTable( {
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
                        filename: 'trade_tests',
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