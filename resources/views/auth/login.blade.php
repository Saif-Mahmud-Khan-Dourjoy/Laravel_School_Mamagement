{{-- @extends('layouts.app') --}}

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="{{asset('admin')}}/js/bootstrap.min.js" type="text/javascript"></script>
<script src="{{asset('admin')}}/js/jquery.min.js" type="text/javascript"></script>
<!------ Include the above in your HEAD tag ---------->
<link href="{{asset('admin')}}/css/login.css" rel="stylesheet" />

<div class="wrapper fadeInDown">



  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    @php
       $settings = \App\GeneralSetting::get('site_logo')->first();
       //dd($settings->site_logo);
    @endphp
    <div class="logo"><br>
        @if($settings != null)
            <img src="{{asset('site_logo')}}/{{$settings->site_logo}}" style="width:140px;height:120px;" alt="Site Logo"/>
        @elseif($settings == null)
            <img src="{{asset('admin/img/demo_logo.png')}}" style="width:140px;height:120px;" alt="Site Logo"/>
        @endif
    </div>
          <!--   success message after changing password -->
     @if(session('successMsg'))
        <div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
          <buttont type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
            <i class="mdi mdi-check-all"></i>
            <strong>Well done!!</strong> {{session('successMsg')}}
          </button>
        </div>
     @endif
<br>
  <!-- Login Form -->
  <div>
    
     <!--  @if(session()->has('loginError'))
                 <div class="alert alert-icon alert-success alert-dismissible fade in text-center">
                    <button style="position: relative; right: 1px; color: black; font-weight: bold" type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ session()->get('loginError') }}
                </div>
                @endif -->
  </div>
  <form  method="POST" action="{{ route('login') }}">
     <div>
      @if ($errors->has('email'))
      <span class="help-block alert-danger">
        <small>{{ $errors->first('email') }}</small>
    </span>
    @endif
    </div>
     <div>
    @if ($errors->has('password'))
    <span class="help-block alert-danger" >
        <small>{{ $errors->first('password') }}</small>
    </span>
    @endif
    </div>
       @csrf
       {{ __('Your Email:') }}
      <input style="border: 1px dotted; border-color: gray;" type="email" id="email" class= "fadeIn second {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus" placeholder="Enter your email">
     
    {{ __('Password:') }}
    <input style="border: 1px dotted; border-color: gray;" type="password" id="password" class="fadeIn third{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Type password">
   

    <input type="submit" class="fadeIn fourth" value=" {{ __('Login') }}">
    <br>

    <input class="fadeIn fourth" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

    <label class="fadeIn fourth" for="remember">
        {{ __('Remember Me') }}
    </label>


    @if (Route::has('password.request'))
    <a class="btn btn-link" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
    </a>
    @endif

</form>

<!-- Remind Passowrd -->
<div id="formFooter">
   &copy; <script>document.write(new Date().getFullYear())</script><i class=""></i> <a href="http://www.systechdigital.com">SYSTECH DIGITAL LIMITED</a>
</div>

</div>
</div>


{{-- 

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 --}}