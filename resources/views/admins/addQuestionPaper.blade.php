@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">      
        <div class="col-sm-10">
             {{-- Add Question form --}}
             <div class="card-outline-info">
                 <div class="card-header"> Question Paper Details </div>
             </div>
             <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="qp_title" class="col-md-4 col-form-label text-md-right">{{ __('Question Paper Title') }}</label>

                            <div class="col-md-6">
                                <input id="qp_title" type="text" class="form-control @error('qp_title') is-invalid @enderror" name="qp_title" value="{{ old('qp_title') }}" required autocomplete="qp_title" autofocus>

                                @error('qp_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="qp_number" class="col-md-4 col-form-label text-md-right">{{ __('Question Paper Number') }}</label>

                            <div class="col-md-6">
                                <input id="qp_number" type="text" class="form-control @error('qp_number') is-invalid @enderror" name="qp_number" value="{{ old('qp_number') }}" required autocomplete="qp_number" autofocus>

                                @error('qp_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="qp_num_of_questions" class="col-md-4 col-form-label text-md-right">{{ __('Number of questions') }}</label>

                            <div class="col-md-6">
                                <input id="qp_num_of_questions" type="number" class="form-control @error('qp_num_of_questions') is-invalid @enderror" name="qp_num_of_questions" value="{{ old('qp_num_of_questions') }}" required autocomplete="qp_num_of_questions" autofocus>

                                @error('qp_num_of_questions')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="qp_class" class="col-md-4 col-form-label text-md-right">{{ __('Number of questions') }}</label>

                            <div class="col-md-6">
                                <input id="qp_class" type="number" class="form-control @error('qp_class') is-invalid @enderror" name="qp_class" value="{{ old('qp_class') }}" required autocomplete="qp_class" autofocus>

                                @error('qp_class')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">                            

                            <div class="col-md-6 text-right">
                               <input type="submit" name="btn_add_paper" value="Add Question Paper" class="btn btn-success ">
                            </div>
                        </div>
                                      
                    </form>
             </div>
             {{-- End Question form --}}
        </div>
    </div>
</div>
@endsection
