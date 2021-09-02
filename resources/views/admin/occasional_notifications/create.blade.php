@section('heading')
    Occasional Notification
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel panel-default">

                    <div class="panel-heading" style="background-color: #f2f2f2;">
                        <h4 class="title" align="center">Add an Occasion</h4>
                    </div>

                    <div class="panel-body">
                    {{-- 	@if (count($errors) > 0)
                            <div class="alert alert-danger errorMsg">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{ $error }} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}
                        <div style="padding-top: 25px;">
                            {!! Form::open(['method' => 'POST', 'url' => '/occasional-notifications']) !!}

                            @include('admin.occasional_notifications.form')

                            <div class="form-group">
                                <div class="text-center">
                                    {!! Form::submit('Submit', array('class'=> 'btn btn-info btn-fill btn-wd')) !!}
                                    <a type="button" href="{{route('occasional-notifications.index')}}" class="btn btn-default btn-fill btn-wd">Cancel</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
	window.addEventListener('load', function(){
		$(document).find('.errorMsg').delay(1000).fadeOut("slow");

            $(function(){
                $('.pick-date').datetimepicker({
                    timepicker:true,
                    //format: 'Y-m-d'
                });
            });
	});
	</script>
@endsection
