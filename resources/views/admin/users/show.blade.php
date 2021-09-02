@section('heading')
User Information
@endsection
@extends('layouts.app')

@section('content')

<?php
$area = \App\Area::find($user->id);
?>
<br>
<!-- original view -->
<div class="row">
     <div class="col-md-5 col-md-offset-1">
        <div class="panel panel-info">
            <div class="panel-heading" style="background-color: #f2f2f2;">
                <!--   <h4 class="title" align="center">Change Password</h4> -->
                <div class="panel-body">

                    <div class="panel-header">
                        <h5 class="card-title" style="text-align: center; padding: 10px;"><b>Change Password</b></h5>
                    </div>
                    @php
                        
                        //dd($errors->any());
                    @endphp
                {{--     @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }} </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}
                    @if(session('status'))
                        <div class="alert alert-success errorMsg">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="post" action="{{route('users.changePassword')}}">
                            {{csrf_field()}}
                            <div class="form-group{{$errors->has('oldpassword') ? 'has-error' : ''}}">
                                <label for="oldpassword"><b>Old Password:</b></label>
                                <input type="password" style="border: 1px dotted;" class="form-control" id="oldpassword" placeholder="Enter old password" name="oldpassword" required autofocus>

                                @if ($errors->has('oldpassword'))
                                <span class="help-block" style="color: red;">{{ $errors->first('oldpassword') }}</span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="pwd"><b>New Password:</b></label>
                                <input type="password" style="border: 1px dotted;" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="Type new password" name="password">

                                @if ($errors->has('password'))
                                <span class="help-block" style="color: red;">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div>
                                <div class="col-md-6">
                                    <button type="submit" style="" class="pull-right btn btn-default">Change Password</button>
                                </div>
                                <div class="col-md-6">
                                    <a type="button" href="{{route('homes.index')}}" class="btn btn-info btn-fill btn-wd">Back</a>
                                </div>
                            </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: #f2f2f2;">
                <h4 class="title" align="center">User Information Details</h4>

                <div class="panel-body">
                    <div style="padding-bottom: 35px;">
                        <div class="content table-responsive table-full-width">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('name','User Name') !!}
                                        {!! Form::label('name', isset( $user->name) ?  $user->name : null, ['class'=> 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! Form::label('email','Email Address:') !!}
                                        {!! Form::label('email', isset($user->email) ? $user->email : null, ['class'=> 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>
</div>
<script type="text/javascript">
    window.addEventListener('load', function(){
        $(document).find('.errorMsg').delay(1000).fadeOut("slow");
    });
</script>
@endsection
