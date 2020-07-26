@extends('layouts.app')

@section('content')
<div class="container">   
    <div class="card-info float-md-none">
        <div class="card-header">
            <h4>Generate a Question Paper</h4>
        </div>
        <div class="card-body text-left bg-white">
            <form action="{{ route('admin.genPaper.submit') }}" method="post">
                @csrf 
                
                 <div class="form-group row">
                    <label for="q_trade" class="col-md-4 col-form-label text-md-right">{{ __('Trade ') }}</label>

                    <div class="col-md-6">
                        <select name="q_trade" class="form-control">
                           <option selected="" disabled="">--select trade--</option>
                           <option>Hotel and Catering</option>
                           <option>Catering Industry</option>
                           <option>Electrical Industry</option>
                           <option>Construction Industry</option>
                        </select>
                        @error('q_trade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>            
                <div class="form-group row">
                    <label for="q_level" class="col-md-4 col-form-label text-md-right">{{ __('Difficulty Level') }}</label>

                    <div class="col-md-6">
                        <select name="q_level" class="form-control">
                            <option disabled="" style="background-color: lightgray;"><-select difficulty-></option>
                            <option>Easy</option>
                            <option>Medium</option>
                            <option>Hard</option>
                        </select>
                    </div>
                </div>    

                <div class="form-group row">
                    <label for="q_cls" class="col-md-4 col-form-label text-md-right">{{ __('Class') }}</label>

                    <div class="col-md-6">
                       <select name="q_class" class="form-control">
                            <option disabled="" style="background-color: lightgray; color: black;"><-select class-></option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                        </select>
                    </div>
                </div>    

                 <div class="form-group row">
                      <label for="btn" class="col-md-4 col-form-label text-md-right"></label>
                     <div class=" col-md-6 text-right">
                          <button type="submit" class="btn btn-success" >Generate Question Paper!</button>
                     </div> 
                 </div>  

                {{-- end form --}}
            </form>
        </div>
    </div>

</div>
@endsection
