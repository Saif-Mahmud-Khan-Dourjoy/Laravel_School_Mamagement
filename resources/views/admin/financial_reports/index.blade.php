@section('heading')
    Financial Report
@endsection

@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Generate Financial Report</h4>
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
                        <div style="padding-top: 25px;">
                            <div style="background-color: #e6ffe6; padding: 10px;">
                                {!! Form::open(['method' => 'POST', 'url' => 'financial_report/generate_report', 'target' => '_blank', 'id' => 'search_form', 'autocomplete' => 'off']) !!}

                                @include('admin.financial_reports.form')
                                
                                <div class="form-group row">
                                    <div class="pull-right pr-4">
                                        <button type="button" id="reset_btn" class="btn btn-info btn-sm btn-round"><i class="fa fa-refresh text-info"></i></button>
                                        <button type="button" id="cancel_btn" class="btn btn-default btn-fill btn-sm">Cancel</button>
                                        {!! Form::submit('Generate', array('class'=> 'btn btn-info btn-fill btn-sm')) !!}
                                    </div>
                                </div>

                                {!! Form::close() !!}
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $(function(){
                $('.pick-date').datetimepicker({
                    timepicker:false,
                    format: 'd-m-yy'
                });
            });
            $('#reset_btn').click(function(){
                $('#search_form').trigger('reset');
            });

            $('#cancel_btn').click(function(){
                window.location.replace(''+jsUtlt.siteUrl("/home")+'');
            });
        });
    </script>
@endsection
