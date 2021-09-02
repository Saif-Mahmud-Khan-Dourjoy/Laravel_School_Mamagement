@section('heading')
Sessions
@endsection

@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
           <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">

                    <div class="panel-heading"  style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Sessions Information Form</h4>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @error('name')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('starts_from')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('ends_to')
                                        <li>{{ $message }}</li>
                                    @enderror
                                    @error('fiscal_year_id')
                                        <li>Fiscal Year field is required.</li>
                                    @enderror
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="panel-body">

                        <div class="header">
                            <h4 class="title">Add Session</h4>
                        </div>
                        {!! Form::open(['method' => 'POST', 'url' => '/sessions']) !!}

                        @include('admin.sessions.form')

                        <div class="form-group">
                            <div class="text-center">
                                {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                {!! link_to(URL::previous(), 'Cancel', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
                            </div>
                        </div>


                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div> 
        </div>
    </div>
@endsection
