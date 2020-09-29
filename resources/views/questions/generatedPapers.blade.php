@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.0/css/buttons.dataTables.min.css"/>
@endsection
@section('content')
{{-- <div class="container"> --}}
    <h4>Structured Questions</h4>
    {{-- <div class="float-right ">
        <a href="/admin/import" class="btn btn-rounded text-white bg-info">Import From Excel</a>
    </div> --}}
    <div class="table table-responsive jumbotron bg-white justify-content-center">
        <table class="table table-responsive table-striped" width="100%" id="question_papers">
            <thead>
                <th>QNo..</th>
                <th>Title</th>
                <th>Number</th>
                <th>Class</th>

                <th>Action</th>
            </thead>
            <tbody>
                @php
                    $counter = 0;
                @endphp
                @foreach($question_papers as $paper)
                <tr>
                    <td>@php
                        $counter += 1;
                        echo $counter;
                    @endphp</td>
                    <td>{{ $paper->qp_title }}</td>
                    <td>{{ $paper->qp_number }}</td>
                    <td>{{ $paper->qp_class }}</td>
                    <td>
                        <div class="dropdown dropdown-action">
                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="/admin/viewPaper/{{ $paper->qp_number }}"><i class="custom-badge status-blue fa fa-refresh m-r-5">&nbsp;View Paper</i></a>
                                 @if(auth::user()->isAdmin)
                                <a class="dropdown-item" {{-- href="/admin/managePaper/{{ $paper->q_number }}" --}}><i class="custom-badge status-red fa fa-refresh m-r-5">&nbsp;Manage</i></a>
                                @endif
                            </div>
                        </div>
                    </td>                   
                </tr>
                @endforeach
            </tbody>
        </table>
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
            $('#question_papers').DataTable( {
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
                        filename: 'question_papers',
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
