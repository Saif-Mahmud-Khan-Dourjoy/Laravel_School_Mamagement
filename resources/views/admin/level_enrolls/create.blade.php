@section('heading')
Classes
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <?php
        $url = Session::get('levelIndexURL');
        //dd(Session::all());
        ?>
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="panel panel-default">

                    <div class="panel-heading"  style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Class Enroll Form</h4>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <br>
                    <div class="panel-body">
                        {!! Form::open(['method' => 'POST', 'url' => '/level_enrolls_assign']) !!}

                        @include('admin.levels.level_enroll_form')

                        <div class="row form-group">
                            <div class="text-right col-md-6">
                                {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                {!! Form::close() !!}
                            </div>
                             <div class="text-left col-md-6">
                                {!! Form::open(['method' => 'GET', 'url' => '/levelEnrolls']) !!}
                                {!! Form::submit('View Enrolled', array('class'=> 'btn btn-primary btn-fill btn-wd')) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
