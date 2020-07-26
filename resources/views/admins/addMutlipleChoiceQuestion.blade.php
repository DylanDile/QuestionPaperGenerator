@extends('layouts.app')

@section('content')
<div class="container">  
  <div class="card">
      <div class="card-header">         
          <center><h4> Multiple Choice Question Details</h4></center>
          <hr>
      </div>
      <div class="card-body">
        {{-- Form Start --}}
          <form method="POST" action="{{ route('admin.addQuestion.submit') }}">
            @csrf
              <div class="row">
                 <div class="col-sm-6">
                     {{-- Start form controls --}}
                      <div class="form-group row">
                        <label for="q_number" class="col-md-4 col-form-label text-md-right">{{ __('Question Number') }}</label>

                        <div class="col-md-6">
                            <input id="q_number" name="q_number" type="number" class="form-control" autofocus value="{{ $lastNumber }}" readonly="">

                            @error('q_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="q_trade" class="col-md-4 col-form-label text-md-right">{{ __('Trade ') }}</label>

                        <div class="col-md-6">
                            <select name="q_trade" class="form-control">
                               <option selected="" disabled="">--select trade--</option>
                               <option>Hotel and Catering</option>
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
                        <label for="q_subject" class="col-md-4 col-form-label text-md-right">{{ __('Question Subject') }}</label>

                        <div class="col-md-6">
                            <input id="q_subject" type="text" class="form-control @error('q_subject') is-invalid @enderror" name="q_subject" value="{{ old('q_subject') }}" required autocomplete="q_subject" autofocus>

                            @error('q_subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>    

                    <div class="form-group row">
                        <label for="question" class="col-md-4 col-form-label text-md-right">{{ __('Question Detail') }}</label>

                        <div class="col-md-6">
                            <textarea name="question" class="form-control" placeholder="Question here?" rows="10"></textarea>
                        </div>
                    </div>    

                   {{--  <div class="form-group row">
                        <label for="q_chapter" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                        <div class="col-md-6">
                            <input id="q_image" type="file" class="form-control @error('q_image') is-invalid @enderror" name="q_image" value="{{ old('q_image') }}" required autocomplete="q_image" autofocus>

                            @error('q_image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>     --}}
                    <div class="form-group row">
                        <label for="q_chapter" class="col-md-4 col-form-label text-md-right">{{ __('Chapter') }}</label>

                        <div class="col-md-6">
                            <input id="q_chapter" type="text" class="form-control @error('q_chapter') is-invalid @enderror" name="q_chapter" value="{{ old('q_chapter') }}" required autocomplete="q_chapter" autofocus>

                            @error('q_chapter')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>  
 
                     {{-- End form controls --}}
                 </div>
                 <div class="col-sm-6">                        

                    <div class="form-group row">
                        <label for="q_weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>

                        <div class="col-md-6">
                            <input id="q_weight" type="number" class="form-control @error('q_weight') is-invalid @enderror" name="q_weight" value="{{ old('q_weight') }}" required autocomplete="q_weight" autofocus placeholder="1">

                            @error('q_weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>    

                    <div class="form-group row">
                        <label for="q_level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>

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
                           <select name="q_cls" class="form-control">
                                <option disabled="" style="background-color: lightgray; color: black;"><-select class-></option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                    </div>

                    {{-- Possible answers --}}

                    <div class="text-center">
                      <h5><b><u>Enter Possible Answers</u></b></h5>
                      <p class="text-danger"><b><small><strong><i>One of your answers must be correct.</i></strong> </small></b></p>
                    </div>
                      <div class="form-group row">
                          <label for="a_answer" class="col-md-4 col-form-label text-md-right">{{ __('A') }}</label>
                          <div class="col-md-6">
                              <input type="text" name="a_answer" class="form-control" required=""  min="1">
                          </div>
                      </div>    

                      <div class="form-group row">
                          <label for="b_answer" class="col-md-4 col-form-label text-md-right">{{ __('B') }}</label>
                          <div class="col-md-6">
                              <input type="text" name="b_answer" class="form-control" required=""  min="1">
                          </div>
                      </div> 

                       <div class="form-group row">
                          <label for="c_answer" class="col-md-4 col-form-label text-md-right">{{ __('C') }}</label>
                          <div class="col-md-6">
                              <input type="text" name="c_answer" class="form-control" required=""  min="1">
                          </div>
                      </div> 

                       <div class="form-group row">
                          <label for="d_answer" class="col-md-4 col-form-label text-md-right">{{ __('D') }}</label>
                          <div class="col-md-6">
                              <input type="text" name="d_answer" class="form-control" required="" min="1">
                          </div>
                      </div> 
                     

                     {{-- Corrent Amswer --}}
                     <div class="form-group row">                        
                          <label for="correct_answer" class="col-md-4 col-form-label text-md-right">{{ __('Corrent Answer') }}</label>
                          <div class="col-md-6">
                           <select name="correct_answer" class="form-control">
                                <option disabled="" style="background-color: lightgray; color: black;"><-select class-></option>
                                <option >A</option>
                                <option >B</option>
                                <option >C</option>
                                <option >D</option>
                            </select>
                        </div>
                      </div> 

                      <input type="hidden" name="q_type" value="multiple_choice" class="form-control">  

                       <div class="form-group row">
                          <label for="btn" class="col-md-4 col-form-label text-md-right"></label>
                         <div class=" col-md-6 text-right">
                              <button type="submit" class="btn btn-success" >Add Question!</button>
                         </div> 
                     </div>  

             {{-- End possible answers --}}
                 </div>

              </div>
          </form>
          {{-- Form End --}}
      </div>
  </div>
</div>
@endsection
