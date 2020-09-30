@extends('layouts.app')

@section('content')
<div class="container  bg-white">   
    <div class="jumbotron bg-white">
        <div class="card">
            <div class="card-header">
                <h3>Schedule Trade Test Time for : {{ $qp_number }}</h3>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('admin.test_schedule.submit') }}">
                    @csrf
                    <input type="hidden" name="qp_number" value="{{ $qp_number }}">
                    <div class="form-group row">
                        <label for="exam_date" class="col-md-4 col-form-label ">{{ __('Exam Date') }}</label>

                        <div class="col-md-9">
                            <input id="exam_date" name="exam_date" type="date" class="form-control" autofocus>

                            @error('exam_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <div class="form-group row">
                        <label for="exam_time" class="col-md-4 col-form-label ">{{ __('Exam Time') }}</label>

                        <div class="col-md-9">
                            <input id="exam_time" name="exam_time" type="time" class="form-control" autofocus>

                            @error('exam_time')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 
                    <input type="submit" name="submit" class="btn btn-success" value="Schedule Test Date">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
