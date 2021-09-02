@section('heading')
Permissions
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Permission Information Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">


                               <div class="row">
                                <div class="col-md-6">
                                 <div class="form-group">
                                    {!! Form::label('name','Name of permission') !!}
                                    {!! Form::label('name', isset($permission->name) ? $permission->name : null, ['class'=> 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name','Name of Description') !!}

                                    {!! Form::label('name', isset($permission->description) ? $permission->description : null, ['class'=> 'form-control']) !!}

                                </div>  
                            </div>
                            
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('name','Created') !!}
                                    {!! Form::label('name', $permission->created_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                </div>

                            </div>
                            <div class="col-md-6">
                             <div class="form-group">
                                {!! Form::label('name','Updated') !!}
                                {!! Form::label('name', $permission->updated_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                            </div>
                        </div>


                    </div>
                    <div class="form-group">
                        <div class="text-center">
                            {!! link_to(URL::previous(), 'Back', ['class' => 'btn btn-default btn-fill btn-wd']) !!}
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

@endsection
