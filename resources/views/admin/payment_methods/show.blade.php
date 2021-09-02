@section('heading')
    Payment Method
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <?php
    //$branch = \App\Branch::find($fiscal_year->branch_id);
    $user = \App\User::find($payment_method->created_by);
    ?>
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading" style="background-color: #f2f2f2;">
                    <h4 class="title" align="center">Payment Method Details</h4>

                    <div class="panel-body">
                        <div style="padding-top: 25px;">
                            <div class="content table-responsive table-full-width">

                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('method_name','Payment Method') !!}
                                            {!! Form::label('method_name', isset($payment_method->method_name) ? $payment_method->method_name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! Form::label('created_by','Created by') !!}
                                            {!! Form::label('created_by', isset($user->name) ? $user->name : null, ['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Created') !!}
                                            {!! Form::label('name', $payment_method->created_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                            {!! Form::label('name','Updated') !!}
                                            {!! Form::label('name', $payment_method->updated_at->toDayDateTimeString(),['class'=> 'form-control']) !!}
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <div class="text-center">
                                        {!! link_to(URL::previous(), 'Back', ['class' => 'btn btn-info btn-fill btn-wd']) !!}
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
