
                        


<!DOCTYPE html>
<html lang="en">


<!-- register24:03-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/img/favi.ico')}}">
    <title>QPGen</title>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}">
    <!--[if lt IE 9]>
    <script src="{{asset('frontend/assets/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/respond.min.js')}}"></script>
    <![endif]-->
</head>

<body>
<div class="main-wrapper  account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <form method="POST" action="{{ route('register') }}" class="form-signin">
                    @csrf
                    <div class="account-logo">
                       <a href="/"><h3>Trade Test Generator</h3></a>
                        <hr>
                       <h4>Register Account</h4>
                    </div>
                     <div class="form-group">
                        <label>Reg Number</label>
                        <input id="ecnumber" type="text" class="form-control @error('ecnumber') is-invalid @enderror" name="ecnumber" value="{{ old('ecnumber') }}" required autocomplete="ecnumber" autofocus>
                        @error('ecnumber')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Full Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Username') }}</label>                        
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>{{ __('Trade') }}</label>                        
                         <select name="trade" class="form-control" required="">
                               <option selected="" disabled="">--select trade--</option>
                               <option>Hotel and Catering</option>
                               <option>Electrical Industry</option>
                               <option>Construction Industry</option>
                            </select>

                        @error('trade')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                     <div class="form-group">
                        <label>Class</label>
                        <input id="class" type="text" class="form-control @error('class') is-invalid @enderror" name="class" value="{{ old('class') }}" required autocomplete="class" autofocus>
                        @error('class')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        <p id="passwordHelpBlock" class="form-text text-muted">
                            Your password must be more than 8 characters long, should contain at-least 1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character.
                        </p>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group checkbox">
                        <label>
                            <input type="checkbox" required> I have read and agree the Terms & Conditions
                        </label>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-warning account-btn" type="submit">Signup</button>
                    </div>
                    <div class="text-center login-link">
                        Already have an account? <a href="/">Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('frontend/assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/app.js')}}"></script>
</body>


<!-- register24:03-->
</html>
