

@section('heading')
    Teachers
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <div>
                            @include('layouts.flash_message')
                        </div>
                        <h4 class="title" align="center">Teacher Information Form</h4>
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

                    <div class="panel-body">

                        <div class="header">
                            <h4 class="title">Edit Teacher info</h4>
                        </div>
                        <!-- {!! Form::open(['method' => 'PUT', 'url' => ['/teachers/'.$teacher->id], 'files'=>'true']) !!} -->

                        @include('admin.teachers.update_form')

                     <!--    <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Update', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                <a href="{{route('teachers.index')}}" class="btn btn-default btn-fill btn-wd"> Cancel</a>  
                            </div>
                            {!! Form::close() !!}
                    </div> -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal-parts')

@include('admin.teachers.educationModal')
@include('admin.teachers.trainingModal')
@include('admin.teachers.previousSchoolModal')
@include('admin.teachers.ntrcaModal')
@include('admin.teachers.scaleChangeModal')

@endsection
